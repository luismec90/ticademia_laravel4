<?php

class PagesController extends BaseController {

    public function test()
    {
        $course = Course::first();

        MaterialUser::with('material')
            ->whereHas('material', function ($q) use ($course)
            {
                $q->whereHas('module', function ($q) use ($course)
                {
                    $q->where('course_id', $course->id);
                });
            })->where('user_id',1)
            ->get();


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
