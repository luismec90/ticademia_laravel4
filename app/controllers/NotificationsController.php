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

        if ($notification->url != "#")
        {
            return Redirect::to($notification->url);
        } else
        {
            return Redirect::back();
        }
    }

}