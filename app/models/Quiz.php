<?php

class Quiz extends \Eloquent {

    protected $fillable = [];

    public function path($course)
    {
        return asset("quizzes/course_{$course->id}/module_{$this->module_id}/quiz_{$this->id}/launch.html");
    }

}