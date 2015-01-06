<?php

class PagesController extends BaseController {

    public function test()
    {
        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->origin = 'levelChange';
        $notification->save();

        //  $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/kAOm3APJopM');
        //  return strval($xml->xpath('//yt:duration[@seconds]')[0]->attributes()->seconds);

    }

    private function approvedQuiz($quiz, $diff)
    {

        $approvedQuiz = new ApprovedQuiz;
        $approvedQuiz->user_id = Auth::user()->id;
        $approvedQuiz->score = 420;
        $approvedQuiz->best_time = $diff;
        $quiz->approvedQuiz()->save($approvedQuiz);


        dd($quiz->approvedQuiz->toArray());

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
