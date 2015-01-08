<?php

class PagesController extends BaseController {

    public function test()
    {

        $user = User::first();

        $course = Course::first();

        $modules = $course->modules;

        $quizAttempts = QuizAttempt::whereHas('quiz', function ($q) use ($course)
        {
            $q->whereHas('module', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $quizAttempts->take(3);

        //  $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/kAOm3APJopM');
        //  return strval($xml->xpath('//yt:duration[@seconds]')[0]->attributes()->seconds);

    }

    private function approvedQuiz($quiz, $diff)
    {

        $approvedQuiz = new ApprovedQuiz;
        $approvedQuiz->user_id = Auth::user()->id;
        $approvedQuiz->score = 420;
        $approvedQuiz->best_time = $diff;
        $quiz->approvedQuiz()->save($approvedQuiz);


        dd($quiz->approvedQuiz->toArray());

    }

    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }

    public function sharer($reachedAchievementID)
    {
        $reachedAchievement = ReachedAchievement::findOrFail($reachedAchievementID);

        return View::make('pages.share', compact('reachedAchievement'));
    }


}
