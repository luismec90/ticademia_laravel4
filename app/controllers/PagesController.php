<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {

    public function test()
    {
         User::join('module_user', 'module_user.user_id', '=', 'users.id')
            ->join('modules', 'module_user.module_id', '=', 'modules.id')
            ->where('modules.course_id',1)
            ->groupBy('module_user.user_id')
            ->select('users.*', DB::raw('SUM(module_user.score) score'))
            ->orderBy('score', 'DESC')
            ->get();
         User::join('module_user', 'module_user.user_id', '=', 'users.id')
            ->join('modules', 'module_user.module_id', '=', 'modules.id')
            ->leftJoin('reached_achievements', function ($join)
            {
                $join->on('users.id', '=', 'reached_achievements.user_id');
                $join->on('modules.course_id', '=', 'reached_achievements.course_id');
            })
            ->leftJoin('achievements', 'reached_achievements.achievement_id', '=', 'achievements.id')
            ->where('modules.course_id', 1)
            ->groupBy('module_user.user_id')
            ->selectRaw('users.*,(SUM(module_user.score) + SUM(achievements.reward)) score')
            ->orderBy('score', 'DESC')
            ->get();

        return "asd";

    }


    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }


}
