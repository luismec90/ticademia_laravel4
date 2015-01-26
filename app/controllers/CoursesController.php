<?php

class CoursesController extends \BaseController {

    public function index()
    {
        $courses = Course::with('subject')->get();

        return View::make('course.index', compact('courses'));
    }


    public function userCourses()
    {
        $courses = Auth::user()
            ->courses()
            ->with('subject')->get();

        return View::make('course.user_courses', compact('courses'));
    }

    public function show($course_id)
    {
        $course = Course::with('modules')
            ->findOrFail($course_id);

        $date = date('Y-m-d H:i:s');

        $moduleID = - 1;
        foreach ($course->modules as $module)
        {
            if (strtotime($date) <= strtotime($module->end_date))
            {
                $moduleID = $module->id;
                break;
            }
        }

        if ($moduleID == - 1)
        {
            $moduleID = $module->id;
        }

        return Redirect::route('module_path', [$course->id, $moduleID]);
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

        $userRanking = ['position' => 'N/A', 'group' => 'N/A', 'score' => 'N/A'];

        foreach ($ranking as $index => $row)
        {
            if ($row->group == $userGroup)
            {
                $userRanking = ['position' => ($index + 1), 'group' => $userGroup, 'score' => $row->score];
                break;
            }
        }

        return View::make('course.ranking.group', compact('course', 'ranking', 'userRanking'));
    }

    public function individualRanking($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        $ranking = $course->individualRanking();
        $userRanking = ['position' => 'N/A', 'fullName' => Auth::user()->fullName(), 'score' => 'N/A'];

        foreach ($ranking as $index => $user)
        {
            if ($user->isMe())
            {
                $userRanking = ['position' => ($index + 1), 'fullName' => $user->fullName(), 'score' => $user->score];
                break;
            }
        }

        return View::make('course.ranking.individual', compact('course', 'ranking', 'userRanking'));
    }

    public function reachedAchievements($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        $reachedAchievements = ReachedAchievement::with('achievement')
            ->where('course_id', $course->id)
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return View::make('course.reached_achievements', compact('course', 'reachedAchievements'));
    }
}