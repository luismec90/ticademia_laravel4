<?php

class PagesController extends BaseController {

    public function test()
    {
        return View::make('emails.auth.reminder',['token'=>'asdasd']);
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
