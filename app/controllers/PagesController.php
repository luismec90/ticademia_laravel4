<?php

class PagesController extends BaseController {

    public function test()
    {
        $countPosts = WallMessage::where('course_id',1)
            ->where('user_id', 1)->count();
        echo $countPosts;
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
