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

    public function generalRanking($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        $ranking = $course->generalRanking();
        $userRanking = ['position' => 'N/A', 'fullName' => Auth::user()->fullName(), 'score' => 'N/A'];

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

    public function reachedAchievements($course_id)
    {
        $course = Course::with('subject')
            ->findOrFail($course_id);

        $reachedAchievements = ReachedAchievement::with('achievement')
            ->where('course_id', $course->id)
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->get();

        return View::make('course.reached_achievements', compact('course', 'reachedAchievements'));
    }
}