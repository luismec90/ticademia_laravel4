<?php

class WallMessagesController extends \BaseController {

    public function index($courseID)
    {
        $course = Course::with('subject')->findOrFail($courseID);

        $wallMessages = WallMessage::with('replies')
            ->with('user')
            ->with('replies.user')
            ->where('course_id', $course->id)
            ->whereNull('wall_message_id')
            ->orderBy('created_at', 'DESC')->paginate(20);

        if (Request::ajax())
        {
            if ($wallMessages->count())
                return Response::json(View::make('course.wall.partials.wall_message', compact('course', 'wallMessages'))->render());
            else
                return "";
        }

        return View::make('course.wall.index', compact('course', 'wallMessages'));
    }

    public function storeMessage($courseID)
    {
        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $wallMessage = new WallMessage;
        $wallMessage->course_id = $courseID;
        $wallMessage->user_id = Auth::user()->id;
        $wallMessage->message = Input::get('message');
        $wallMessage->save();

        Flash::success('Publicación creada exitosamente');

        return Redirect::back();
    }

    public function storeReply($courseID, $wall_message_id)
    {
        $wallMessage = WallMessage::where('course_id', $courseID)->findOrFail($wall_message_id);

        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $wallMessageReply = new WallMessage;
        $wallMessageReply->course_id = $courseID;
        $wallMessageReply->user_id = Auth::user()->id;
        $wallMessageReply->wall_message_id = $wallMessage->id;
        $wallMessageReply->message = Input::get('message');
        $wallMessageReply->save();

        Flash::success('Publicación creada exitosamente');

        return Redirect::back();
    }

    public function update($courseID)
    {

        $wall_message_id = Input::get('wall_message_id');

        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $wallMessage = WallMessage::where('course_id', $courseID)
            ->where('user_id', Auth::user()->id)
            ->whereNull('achievement_id')
            ->findOrFail($wall_message_id);

        $wallMessage->message = Input::get('message');

        $wallMessage->save();

        Flash::success('Publicación editada exitosamente');

        return Redirect::back();
    }

    public function destroy($courseID)
    {
        $wall_message_id = Input::get('wall_message_id');

        $wallMessage = WallMessage::where('course_id', $courseID)
            ->where('user_id', Auth::user()->id)
            ->findOrFail($wall_message_id);

        $wallMessage->delete();

        Flash::success('Publicación eliminada exitosamente');

        return Redirect::back();
    }

    public function shareAchievement($courseID, $achievementID)
    {
        $course = Course::find($courseID);

        $achievement = Achievement::findOrFail($achievementID);

        if (AchievementHelper::dontHaveTheAchievement(Auth::user(), $course, $achievementID))
        {
            Flash::error('No tienes el logro:' + $achievement->name);

            return Redirect::back();
        }


        $wallMessage = new WallMessage;
        $wallMessage->course_id = $courseID;
        $wallMessage->user_id = Auth::user()->id;
        $wallMessage->achievement_id = $achievement->id;
        $wallMessage->message = "He obtenido el logro: <b>$achievement->name</b>.";
        $wallMessage->save();

        Flash::success('El logro se ha compartido exitosamente');

        return Redirect::route('wall_path', $course->id);
    }
}