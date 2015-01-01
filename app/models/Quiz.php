<?php

class Quiz extends \Eloquent {

    protected $fillable = [];

    public function path($course)
    {
        return asset("quizzes/course_{$course->id}/module_{$this->module_id}/quiz_{$this->id}/launch.html");
    }

    public function userQuizAttempts()
    {
        return $this->hasMany('QuizAttempt')->where('user_id', Auth::user()->id);
    }

    public function quizType()
    {
        return $this->belongsTo('QuizType');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}