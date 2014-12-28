<?php

class PagesController extends BaseController {

    public function test()
    {
        $user = Auth::user();
        $course = Course::first();
        $achievement_id = 1;

        if (!Achievement::haveTheAchievement($user, $course, $achievement_id))
        {

        }
    }


    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }


}
