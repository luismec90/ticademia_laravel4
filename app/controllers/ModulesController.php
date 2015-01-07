<?php

class ModulesController extends \BaseController {


    public function show($courseID, $moduleID)
    {

        $course = Course::with('subject')->findOrFail($courseID);

        $module = Module::with(['materials',
            'materials.userPlayBackTime',
            'materials.reviewsWithComments',
            'materials.userReviews',
            'quizzes',
            'quizzes.userQuizAttempts' => function ($q) use ($course)
            {
                $q->selectRaw("quiz_id, SUM(case when grade>={$course->threshold} then 1 else 0 end) AS successful_attempts, COUNT(id) AS total_attempts")
                    ->groupBy('quiz_id');

            },
            'quizzes.quizType',
            'quizzes.user',
            'quizzes.approvedQuiz'])->findOrFail($moduleID);


       // return $module;

        $ranking = User::join('module_user', 'module_user.user_id', '=', 'users.id')
            ->join('modules', 'module_user.module_id', '=', 'modules.id')
            ->where('modules.id', $moduleID)
            ->groupBy('module_user.user_id')
            ->select('users.*', DB::raw('SUM(module_user.score) score'))
            ->orderBy('score', 'DESC')
            ->paginate(15);

        if (Request::ajax())
        {
            return Response::json(View::make('course.module.partials.main', compact('course', 'module', 'ranking'))->render());
        }

        $currentModuleID=$moduleID;

        return View::make('course.module.show', compact('course', 'module', 'ranking','currentModuleID'));
    }


    public function playbackTime($courseID, $moduleID)
    {

        if (Input::has('materialID') && Input::has('playbackTime'))
        {
            $module = Module::where('course_id', $courseID)->findOrFail($moduleID);

            $material = Material::where('module_id', $module->id)->findOrFail(Input::get('materialID'));

            $materialUser = new MaterialUser;
            $materialUser->user_id = Auth::user()->id;
            $materialUser->material_id = $material->id;
            $materialUser->playback_time = round(Input::get('playbackTime'));
            $materialUser->save();

            return $this->show($courseID, $moduleID);
        }
    }
}