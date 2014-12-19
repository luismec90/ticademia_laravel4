<?php

class WallMessagesController extends \BaseController {

    public function index($course_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

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

        Flash::success('Publicación creada exitosamente');

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

        $wallMessageReply = new WallMessage;
        $wallMessageReply->course_id = $course_id;
        $wallMessageReply->user_id = Auth::user()->id;
        $wallMessageReply->wall_message_id = $wallMessage->id;
        $wallMessageReply->message = Input::get('message');
        $wallMessageReply->save();

        Flash::success('Publicación creada exitosamente');

        return Redirect::back();
    }

    public function update($course_id)
    {

        $wall_message_id = Input::get('wall_message_id');

        if (Input::get('message') == '')
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $wallMessage = WallMessage::where('course_id', $course_id)
            ->where('user_id', Auth::user()->id)
            ->findOrFail($wall_message_id);

        $wallMessage->message = Input::get('message');

        $wallMessage->save();

        Flash::success('Publicación editada exitosamente');

        return Redirect::back();
    }

    public function destroy($course_id)
    {
        $wall_message_id = Input::get('wall_message_id');

        $wallMessage = WallMessage::where('course_id', $course_id)
            ->where('user_id', Auth::user()->id)
            ->findOrFail($wall_message_id);

        $wallMessage->delete();

        Flash::success('Publicación eliminada exitosamente');

        return Redirect::back();
    }

}