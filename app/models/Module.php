<?php

class Module extends \Eloquent {

    protected $fillable = [];

    public function materials()
    {
        return $this->hasMany('Material');
    }

    public function quizzes()
    {
        return $this->hasMany('Quiz');
    }


    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function report($totalQuizzes)
    {
        $query = "SELECT cu.group,u.dni,u.email,u.last_name,u.first_name,ROUND(COUNT(aq.id)/$totalQuizzes*100,2) porcetage
FROM approved_quizzes aq
JOIN quizzes q ON aq.quiz_id=q.id
JOIN users u ON aq.user_id=u.id
JOIN course_user cu ON cu.user_id=u.id AND cu.course_id={$this->course_id}
WHERE aq.skipped=0
AND aq.created_at<='{$this->end_date}'
GROUP BY u.id,q.module_id";

        return DB::select($query);
    }
}