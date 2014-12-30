<?php

class Review extends Eloquent {

    public static $rules = [
        'material_id' => 'required',
        'rating'      => 'required|integer|between:1,10'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function material()
    {
        return $this->belongsTo('Material');
    }

}