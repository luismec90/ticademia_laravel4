<?php

class PagesController extends BaseController {

    public function test()
    {
        $starDate = "2015-02-02 00:00:00";
        for ($i = 1; $i <= 16; $i ++)
        {
            $fecha = new DateTime($starDate);
            $fecha->add(new DateInterval('P6DT23H59M59S'));
            $endDate = $fecha->format('Y-m-d H:i:s');

            echo "Inicio: $starDate <br>";
            echo "Fin: $endDate <br>";
            echo "<hr>";
            $fecha->add(new DateInterval('PT1S'));
            $starDate = $fecha->format('Y-m-d H:i:s');
        }
        // return View::make('pages.test');
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
