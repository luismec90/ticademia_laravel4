<?php

class ForumController extends \BaseController {


    public function index($course_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $topics = Topic::with(['user', 'replies' => function ($q)
        {
            $q->orderBy('created_at', 'DESC');
        }])
            ->where('course_id', $course->id)
            ->orderBy('created_at', 'ASC')
            ->get();

        return View::make('course.forum.index', compact('course', 'topics'));
    }

    public function show($course_id, $topic_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $topic = Topic::with('user')
            ->where('course_id', $course->id)
            ->findOrFail($topic_id);

        $topicReplies = TopicReply::with('user')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'ASC')
            ->get();

        return View::make('course.forum.topic', compact('course', 'topic', 'topicReplies'));
    }

    public function storeReply($course_id, $topic_id)
    {
        $course = Course::findOrFail($course_id);

        $topic = Topic::where('course_id', $course_id)->findOrFail($topic_id);

        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $topicReply = new TopicReply;
        $topicReply->user_id = Auth::user()->id;
        $topicReply->topic_id = $topic->id;
        $topicReply->reply = Input::get('message');
        $topicReply->save();

        AchievementHelper::achievement_primeraParticipacionForo(Auth::user(), $course);
        AchievementHelper::achievement_muyParticipativo(Auth::user(), $course);
        AchievementHelper::achievement_superParticipativo(Auth::user(), $course);

        Flash::success('Mensaje creado exitosamente');

        Session::flash('storedReply', true);


        $tutors = $course->users()->where('role', 2)
            ->where('user_id', '<>', Auth::user()->id)
            ->lists('user_id');

        $usersFromTopic = TopicReply::where('topic_id', $topic->id)
            ->where('user_id', '<>', Auth::user()->id)
            ->distinct('user_id')
            ->lists('user_id');

        $quiz = Quiz::where('topic_id', $topic->id)->firstOrFail();

        $usersApprovedQuiz = ApprovedQuiz::where('quiz_id', $quiz->id)
            ->where('user_id', '<>', Auth::user()->id)
            ->whereIn('user_id', $usersFromTopic)
            ->lists('user_id');

        $usersToNotify = array_diff($usersFromTopic, $usersApprovedQuiz);

        $usersToNotify = (array_unique(array_merge($usersToNotify, $tutors)));

        foreach ($usersToNotify as $user)
        {
            $notification = new Notification;
            $notification->user_id = $user;
            $notification->title = "Nuevo mensaje en el foro: {$topic->name}";
            $notification->url = route('topic_path', [$course->id, $topic->id]);
            $notification->body = "EL " . Auth::user()->roleNameForNotications($course->id) . " " . Auth::user()->fullName() . " ha publicado una respuesta en el foro: <b>{$topic->name}</b>";
            $notification->save();
        }

        return Redirect::back();
    }


    public function updateReply($course_id, $topic_id)
    {
        $topic = Topic::where('course_id', $course_id)
            ->findOrFail($topic_id);

        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $topic_reply_id = Input::get('topic_reply_id');

        $topicReply = TopicReply::where('topic_id', $topic->id)
            ->where('user_id', Auth::user()->id)
            ->findOrFail($topic_reply_id);

        $topicReply->reply = Input::get('message');

        $topicReply->save();

        Flash::success('Mensaje editado exitosamente');

        return Redirect::back();
    }

    public function destroyReply($course_id, $topic_id)
    {
        $topic = Topic::where('course_id', $course_id)
            ->findOrFail($topic_id);


        $topic_reply_id = Input::get('topic_reply_id');

        $topicReply = TopicReply::where('topic_id', $topic->id)
            ->where('user_id', Auth::user()->id)
            ->findOrFail($topic_reply_id);

        $topicReply->delete();

        Flash::success('Mensaje eliminado exitosamente');

        return Redirect::back();
    }

    public function likeTopicReply($courseID)
    {
        $course = Course::findOrFail($courseID);

        $topicReply = TopicReply::whereHas('topic', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->findOrFail(Input::get('topic_reply_id'));

        $like = Like::where('user_id', Auth::user()->id)
            ->where('topic_reply_id', $topicReply->id)
            ->first();

        if (is_null($like))
        {
            $like = new Like;
            $like->user_id = Auth::user()->id;
            $like->topic_reply_id = $topicReply->id;
            $like->save();

            if (!$topicReply->user->isMe())
            {
                AchievementHelper::achievement_meGustaTopicReply($topicReply->user, $course, $topicReply); //Si el like no fue en un post del mismo usuario tiene sentido verificar el logro

                $notification = new Notification;
                $notification->user_id = $topicReply->user_id;
                $notification->title = 'Has ganado un nuevo logro';
                $notification->url = route('topic_path', [$course->id, $topicReply->topic_id]);
                $notification->body = "El usuario " . Auth::user()->fullName() . " le ha dado me gusta a tu publicación en el foro del curso: " . $course->subject->name;
                $notification->save();
            }
        }

        return $topicReply->likes->count();
    }

    public function unlikeTopicReply($courseID)
    {
        $course = Course::findOrFail($courseID);

        $topicReply = TopicReply::whereHas('topic', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->findOrFail(Input::get('topic_reply_id'));


        $like = Like::where('user_id', Auth::user()->id)
            ->where('topic_reply_id', $topicReply->id)
            ->first();

        if (!is_null($like))
            $like->delete();

        return $topicReply->likes->count();
    }

    public function whoLikeTopicReply($courseID)
    {
        $course = Course::findOrFail($courseID);

        $topicReply = TopicReply::with(['likes', 'likes.user'])
            ->whereHas('topic', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            })->findOrFail(Input::get('topic_reply_id'));

        return $topicReply->likes;
    }

}