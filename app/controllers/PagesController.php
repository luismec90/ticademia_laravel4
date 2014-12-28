<?php

class PagesController extends BaseController {

    public function test()
    {

        Achievement::create([
            'name'        => '10 en línea',
            'description' => 'Se gana cuando se resuelven 10 ejercicios consecutivos.'
        ]);

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
