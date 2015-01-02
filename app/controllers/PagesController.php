<?php

class PagesController extends BaseController {

    public function test()
    {
        $quiz=Quiz::find(1);

        $quiz->approvedQuiz = 5;
        $quiz->approvedQuiz->save();
        return $quiz->approvedQuiz;

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


}
