<?php

class Course extends \Eloquent {

    protected $fillable = [];

    public function subject()
    {
        return $this->belongsTo('Subject');
    }

    public function modules()
    {
        return $this->hasMany('Module')->orderBy('start_date');
    }

    public function wallMessages()
    {
        return $this->hasMany('WallMessage')->whereNull('wall_message_id')->orderBy('created_at', 'DESC')->paginate(20);
    }

    public function groupRanking()
    {
        $query = DB::select("SELECT T.group,Round((0.3*T.max_score+0.7*T.avg_score-sqrt(T.standard_deviation))) score
                       FROM (SELECT cu.group,MAX(mu.score) max_score,AVG(mu.score) avg_score,STDDEV_SAMP(mu.score) standard_deviation
                            FROM course_user cu
                            JOIN module_user mu ON cu.user_id=mu.user_id
                            WHERE cu.course_id={$this->id}
                            GROUP BY cu.group) T
                       ORDER BY score DESC");

        return $query;

    }
}