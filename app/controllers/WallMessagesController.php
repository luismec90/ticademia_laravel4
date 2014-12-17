<?php

class WallMessagesController extends \BaseController {

    public function index($course_id)
    {
        $course = Course::with('subject')
            ->with('wallMessages')
            ->with('wallMessages.replies')
            ->with('wallMessages.user')
            ->with('wallMessages.replies.user')
            ->findOrFail($course_id);

        return View::make('course.wall', compact('course'));
    }

    public function storeMessage($course_id)
    {
        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $wallMessage = new WallMessage;
        $wallMessage->course_id = $course_id;
        $wallMessage->user_id = Auth::user()->id;
        $wallMessage->message = Input::get('message');
        $wallMessage->save();

        Flash::success('Comentario creado exitosamente');

        return Redirect::back();
    }

    public function storeReply($course_id, $wall_message_id)
    {
        $wallMessage = WallMessage::where('course_id', $course_id)->findOrFail($wall_message_id);

        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $wallMessage = new WallMessage;
        $wallMessage->course_id = $course_id;
        $wallMessage->user_id = Auth::user()->id;
        $wallMessage->wall_message_id = $wall_message_id;
        $wallMessage->message = Input::get('message');
        $wallMessage->save();


        Flash::success('Comentario creado exitosamente');

        return Redirect::back();
    }
}