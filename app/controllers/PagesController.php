<?php

class PagesController extends BaseController {

    public function test()
    {
       $module=Module::with('quizzes','quizzes.quizType')->first();

       return $module->quizzes[0]->quizType->name;
        return "asd";


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
