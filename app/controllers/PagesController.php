<?php

class PagesController extends BaseController {

    public function test()
    {

       return  MaterialUser::whereHas('material', function ($q)
        {
            $q->whereHas('module', function ($q)
            {
                $q->where('course_id', 1);
            });
        })->where('user_id', 1)
           ->select('material_id')
            ->distinct()
           ->get()
           ->count();

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
