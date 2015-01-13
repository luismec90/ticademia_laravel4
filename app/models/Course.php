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
        $query = DB::select("SELECT T.group,Round((0.3*T.max_score+0.7*T.avg_score-sqrt(T.standard_deviation))) score
                       FROM (SELECT cu.group,MAX(mu.score) max_score,AVG(mu.score) avg_score,STDDEV_SAMP(mu.score) standard_deviation
                            FROM course_user cu
                            JOIN module_user mu ON cu.user_id=mu.user_id
                            WHERE cu.course_id={$this->id}
                            GROUP BY cu.group) T
                       ORDER BY score DESC");

        return $query;

    }

    public function generalRanking()
    {
        return User::join('module_user', 'module_user.user_id', '=', 'users.id')
            ->join('modules', 'module_user.module_id', '=', 'modules.id')
            ->where('modules.course_id', $this->id)
            ->groupBy('module_user.user_id')
            ->select('users.*', DB::raw('SUM(module_user.score) score'))
            ->orderBy('score', 'DESC')
            ->get();
    }

    public function imagePath()
    {
        return asset("courses/course_{$this->id}/{$this->image}");
    }
}