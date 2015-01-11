<?php

class PagesController extends BaseController {

    public function test()
    {
        $course = Course::first();
        $module = Module::first();
        $totalQuizzes=$module->quizzes->count();


        $query = "SELECT cu.group,u.dni,u.email,u.last_name,u.first_name,ROUND(COUNT(aq.id)/$totalQuizzes*100,2) porcetage
FROM approved_quizzes aq
JOIN quizzes q ON aq.quiz_id=q.id
JOIN users u ON aq.user_id=u.id
JOIN course_user cu ON cu.user_id=u.id AND cu.course_id={$course->id}
WHERE aq.skipped=0
AND aq.created_at<='{$module->end_date}'
GROUP BY u.id,q.module_id";

        echo $query;

        var_dump(DB::select($query));


        //  $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/kAOm3APJopM');
        //  return strval($xml->xpath('//yt:duration[@seconds]')[0]->attributes()->seconds);

    }


    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }

    public function share($reachedAchievementID)
    {
        $reachedAchievement = ReachedAchievement::findOrFail($reachedAchievementID);

        return View::make('pages.share', compact('reachedAchievement'));
    }


}
