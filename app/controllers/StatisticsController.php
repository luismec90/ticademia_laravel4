<?php

class StatisticsController extends \BaseController {


    public function students($courseID)
    {
        $course = Course::findOrFail($courseID);
        $totalStudents = $course->users()
            ->where('role', 1)
            ->count();

        $data[0] = ['Nivel', 'Cantidad de estudiantes'];

        $levels = Level::all();

        $i = 1;

        foreach ($levels as $level)
        {
            $data[$i] = [$level->name, DB::table('course_user')
                ->where('course_id', $courseID)
                ->where('level_id', $level->id)
                ->where('role', 1)
                ->count()];

            $i ++;
        }

        return View::make('course.statistics.students', compact('course', 'data', 'totalStudents'));
    }

    public function moduleReport($courseID)
    {
        $course = Course::with('modules')->findOrFail($courseID);

        $selectModules[''] = 'Seleccionar...';

        foreach ($course->modules as $module)
        {
            $selectModules[$module->id] = $module->name;
        }

        return View::make('course.statistics.module_report', compact('course', 'selectModules'));
    }

    public function downloadModuleReport($courseID)
    {
        $moduleID = Input::get('module');

        if ($moduleID == '')
        {
            Flash::error('Por favor selecciona un móduloi');

            return Redirect::back();
        }

        $module = Module::where('course_id', $courseID)->findOrFail($moduleID);

        $totalQuizzes = $module->quizzes->count();

        $data = $module->report($totalQuizzes);

        $data = json_decode(json_encode($data), true);

        Excel::create($module->name, function ($excel) use ($data, $module)
        {

            $excel->sheet('Hoja 1', function ($sheet) use ($data, $module)
            {

                $sheet->fromArray($data);

                $sheet->row(1, array(
                    'Grupo', 'DNI', 'Correo', 'Apellidos', 'Nombres', 'Porcentaje'
                ));

                $sheet->prependRow(1, array(
                    "Módulo: $module->name"
                ));

                $sheet->mergeCells('A1:F1');

                $sheet->prependRow(2, array(
                    "Fecha de corte: $module->end_date"
                ));

                $sheet->mergeCells('A2:F2');
            });

        })->download('xlsx');
    }

    public function quizzes($courseID)
    {
        $course = Course::findOrFail($courseID);

        $data[0] = ['Fecha', 'Evaluaciones intentadas', 'Evaluaciones resueltas'];

        $quizzesAttempts = QuizAttempt::join('quizzes', 'quizzes.id', '=', 'quiz_attempt,quiz_id')
            ->join('modules', 'modules.id', '=', 'quizzes,module_id')
            ->select('quiz_attempt.* ')
            ->get();

        $i = 1;

        /*
                foreach ($levels as $level)
                {
                    $data[$i] = [$level->name, DB::table('course_user')
                        ->where('course_id', $courseID)
                        ->where('level_id', $level->id)
                        ->where('role', 1)
                        ->count()];

                    $i ++;
                }
        */

        return View::make('course.statistics.quizzes', compact('course', 'data'));
    }

}