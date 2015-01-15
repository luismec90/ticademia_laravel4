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

    public function report($totalQuizzes, $withUserID = false)
    {
        $query = "SELECT " . ($withUserID ? "u.id," : "") . "cu.group,u.dni,u.email,u.last_name,u.first_name,COALESCE(T.percentage,0) percentage FROM course_user cu
JOIN users u ON u.id=cu.user_id
LEFT JOIN (SELECT aq.user_id,ROUND(COUNT(aq.id)/$totalQuizzes*100,2) percentage
FROM approved_quizzes aq
JOIN quizzes q ON aq.quiz_id=q.id
WHERE aq.skipped=0
AND aq.created_at<='{$this->end_date}'
GROUP BY aq.user_id) AS T ON T.user_id=u.id
WHERE cu.course_id={$this->course_id}
AND cu.role=1
GROUP BY u.id
ORDER BY cu.group,u.last_name";

        return DB::select($query);
    }
}