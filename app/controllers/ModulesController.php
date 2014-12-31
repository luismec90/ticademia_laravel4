<?php

class ModulesController extends \BaseController {


    public function show($course_id, $module_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $module = Module::with(['materials',
            'materials.userPlayBackTime',
            'materials.reviews'        => function ($q)
            {
                $q->where('user_id', Auth::user()->id);

            }, 'quizzes',
            'quizzes.userQuizAttempts' => function ($q) use ($course)
            {
                $q->selectRaw("quiz_id, SUM(case when grade>={$course->threshold} then 1 else 0 end) AS successful_attempts, COUNT(id) AS total_attempts")
                    ->groupBy('quiz_id');

            }])->findOrFail($module_id);



        return View::make('course.module.show', compact('course', 'module'));
    }

}