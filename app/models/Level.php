<?php

class Level extends \Eloquent {

    protected $fillable = [];


    public function imagePath($gender = 'm')
    {
        $gender = $gender == 'm' ? 'male' : 'female';

        return asset("assets/images/course/levels/$gender/{$this->image}");
    }
}