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

    public function users()
    {
        return $this->belongsToMany('User')->withTimestamps()->withPivot(['level_id', 'role', 'contact_information', 'group']);
    }

    public function groupRanking()
    {
        $query = DB::select("SELECT T2.group,Round((0.3*T2.max_score+0.7*T2.avg_score-sqrt(T2.standard_deviation))) score
                            FROM (SELECT cu.group,MAX(mu.score + COALESCE(T.reward,0)+ COALESCE(TT.bet,0)) max_score,AVG(mu.score + COALESCE(T.reward,0)+ COALESCE(TT.bet,0)) avg_score,STDDEV_SAMP(mu.score + COALESCE(T.reward,0)+ COALESCE(TT.bet,0)) standard_deviation
                            FROM course_user cu
                            JOIN module_user mu ON cu.user_id=mu.user_id
                            LEFT JOIN (SELECT ra.user_id,SUM(a.reward) reward
                            FROM reached_achievements ra
                            JOIN achievements a ON ra.achievement_id=a.id
                            WHERE ra.course_id='{$this->id}'
                            GROUP BY ra.user_id
                            ) AS T ON T.user_id=mu.user_id
                            LEFT JOIN (SELECT d.winner_user_id user_id,SUM(d.bet) bet
                            FROM duels d
                            WHERE d.course_id='{$this->id}'
                            AND winner_user_id IS NOT NULL
                            GROUP BY d.winner_user_id) AS TT ON TT.user_id=mu.user_id
                            WHERE cu.course_id={$this->id}
                            AND cu.group IS NOT NULL
                            GROUP BY cu.group) AS T2
                            ORDER BY score DESC");

        return $query;

    }

    public function individualRanking()
    {
        $query = DB::select("SELECT u.*,SUM(mu.score) quizzes_score,COALESCE(T.reward,0) achievements_score,COALESCE(T2.bet,0) bet,(SUM(mu.score) + COALESCE(T.reward,0)+COALESCE(T2.bet,0)) score
                            FROM users u
                            JOIN module_user mu ON mu.user_id = u.id
                            JOIN modules m ON mu.module_id = m.id
                            LEFT JOIN (SELECT ra.user_id,SUM(a.reward) reward
                            FROM reached_achievements ra
                            JOIN achievements a ON ra.achievement_id=a.id
                            WHERE ra.course_id='{$this->id}'
                            GROUP BY ra.user_id) AS T ON T.user_id=u.id
                            LEFT JOIN (SELECT d.winner_user_id user_id,SUM(d.bet) bet
                            FROM duels d
                            WHERE d.course_id='{$this->id}'
                            AND winner_user_id IS NOT NULL
                            GROUP BY d.winner_user_id) AS T2 ON T2.user_id=u.id
                            where m.course_id = '{$this->id}'
                            GROUP BY u.id
                            ORDER BY score DESC");

        return $query;
    }

    public function imagePath()
    {
        return asset("courses/course_{$this->id}/{$this->image}");
    }
}