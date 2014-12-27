<?php

class ForumController extends \BaseController {


    public function index($course_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $topics = Topic::with('user')
            ->where('course_id', $course->id)
            ->get();


        foreach ($topics as $topic)
        {
            $lasReply = TopicReply::where('topic_id', $topic->id)->orderBy('created_at', 'DESC')->get()->first();
            $topic->lastReply = $lasReply;
        }

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

        Flash::success('Mensaje creado exitosamente');

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

}