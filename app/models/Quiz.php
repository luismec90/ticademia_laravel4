<?php

class Quiz extends \Eloquent {

    protected $fillable = [];

    public static $updateRules = [
        'quizTypeID' => 'required'
    ];


    public function path($course)
    {
        // Para producción
        return asset("quizzes/course_{$course->id}/module_{$this->module_id}/quiz_{$this->id}/launch.html?" . date('Y-m-d H:i:s'));
        // Para desarrollo
        //return asset("quizzes/course_1/module_1/quiz_1/launch.html");
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

    public function approvedQuiz()
    {
        return $this->hasOne('ApprovedQuiz')->where('user_id', Auth::user()->id);
    }

    public function module()
    {
        return $this->belongsTo('Module');
    }

    public function topic()
    {
        return $this->belongsTo('Topic');
    }


    public function prevQuizIsApproved()
    {
        $prevQuiz = Quiz::where('module_id', $this->module_id)
            ->where('order', $this->order - 1)
            ->first();

        if (is_null($prevQuiz) || !is_null($prevQuiz->approvedQuiz))
        {
            return true;
        } else
        {
            return false;
        }

    }

    public function materials()
    {
        return $this->belongsToMany('Material');
    }

}