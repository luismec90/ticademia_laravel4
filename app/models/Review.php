<?php

class Review extends Eloquent {

    public static $rules = [
        'material_id' => 'required',
        'score'       => 'required|numeric|between:0,5'
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