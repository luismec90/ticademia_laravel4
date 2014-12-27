<?php

class CoursesController extends \BaseController {

    public function index()
    {
        $courses = Auth::user()
            ->courses()
            ->with('subject')->get();

        return View::make('course.index', compact('courses'));
    }

    public function show($course_id)
    {
        $course = Course::with('subject')
            ->with('modules')
            ->findOrFail($course_id);

        return View::make('course.show', compact('course'));
    }

    public function calendar($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        return View::make('course.calendar', compact('course'));
    }

    public function groupRanking($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        $ranking = $course->groupRanking();

        $userGroup = Auth::user()->courses()->where('course_id', $course_id)->first()->pivot->group;

        $userRanking = "N/A";

        foreach ($ranking as $index => $row)
        {
            if ($row->group == $userGroup)
            {
                $userRanking = ['position' => ($index + 1), 'group' => $userGroup, 'score' => $row->score];
                break;
            }
        }

        return View::make('course.ranking.group', compact('course', 'ranking','userRanking'));
    }

    public function generalRanking($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        $ranking = User::join('module_user', 'module_user.user_id', '=', 'users.id')
            ->join('modules', 'module_user.module_id', '=', 'modules.id')
            ->where('modules.course_id', $course_id)
            ->groupBy('module_user.user_id')
            ->select('users.*', DB::raw('SUM(module_user.score) score'))
            ->orderBy('score', 'DESC')
            ->get();

        $userRanking = "N/A";
        foreach ($ranking as $index => $user)
        {
            if ($user->isMe())
            {
                $userRanking = ['position' => ($index + 1), 'fullName' => $user->fullName(), 'score' => $user->score];
                break;
            }
        }

        return View::make('course.ranking.general', compact('course', 'ranking', 'userRanking'));
    }

}