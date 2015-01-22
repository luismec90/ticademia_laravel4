<?php

class PagesController extends BaseController {

    public function test()
    {
        $totalTime = Connection::selectRaw('ROUND(SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at))/3600,1) total')
            ->where('user_id', 1)
            ->where('course_id', 1)
            ->groupBy('user_id')
            ->get();
        if ($totalTime->count() > 0)
        {
            $totalTime = $totalTime[0]->total;

            return $totalTime;
        }
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
