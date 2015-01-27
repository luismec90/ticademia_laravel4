<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {

    public function test()
    {
        $quiz=Quiz::first();
        return ;
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
