<?php

class NotificationsController extends \BaseController {


    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(15);

        return View::make('pages.notifications.index', compact('notifications'));
    }

    public function show($notificacion_id)
    {
        $notification = Notification::where('user_id', Auth::user()->id)->findOrFail($notificacion_id);
        $notification->viewed = 1;
        $notification->save();

        if ($notification->url != "")
        {
            return Redirect::to($notification->url);
        } else
        {
            return Redirect::back();
        }
    }

    /* Mostrar modal con la notificación */
    public function load()
    {
        $notification = Notification::where('user_id', Auth::user()->id)
            ->where('viewed', 0)
            ->where('show_modal', 1)
            ->orderBy('created_at', 'ASC')
            ->first();

        if (is_null($notification))
            return;

        $notification->viewed = 1;
        $notification->save();

        return Response::json(View::make('layouts.partials.modal_notification', ['title' => $notification->title, 'image' => $notification->image, 'body' => $notification->body])->render());

    }
}