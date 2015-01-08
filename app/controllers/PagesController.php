<?php

class PagesController extends BaseController {

    public function test()
    {
        $user = User::first();

        $quiz = Quiz::first();
        $oldBestTime='5.214';
        return View::make('emails.notify', compact('user', 'quiz','oldBestTime'));


        //  $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/kAOm3APJopM');
        //  return strval($xml->xpath('//yt:duration[@seconds]')[0]->attributes()->seconds);

    }


    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }

    public function share($reachedAchievementID)
    {
        $reachedAchievement = ReachedAchievement::findOrFail($reachedAchievementID);

        return View::make('pages.share', compact('reachedAchievement'));
    }


}
