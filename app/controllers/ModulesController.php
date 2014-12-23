<?php

class ModulesController extends \BaseController {


    public function show($course_id, $module_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $module = Module::with('materials')
            ->findOrFail($module_id);

        return View::make('course.module.show', compact('course', 'module'));
    }

}