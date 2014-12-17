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
            ->findOrFail($course_id);

        return View::make('course.show', compact('course'));
    }


}