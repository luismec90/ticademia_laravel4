<?php

class StatisticsController extends \BaseController {


    public function students($courseID)
    {
        $course = Course::findOrFail($courseID);

        $data[0] = ['Nivel','Cantidad de estudiantes'];

        $levels = Level::all();

        $i = 1;

        foreach ($levels as $level)
        {
            $data[$i] = [$level->name, DB::table('course_user')
                ->where('course_id', $courseID)
                ->where('level_id', $level->id)
                ->count()];

            $i ++;
        }

        return View::make('course.statistics.students', compact('course', 'data'));
    }

}