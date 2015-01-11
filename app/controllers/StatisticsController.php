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

    public function materials($courseID)
    {
        $course = Course::findOrFail($courseID);
        $totalMaterials = Material::whereHas('module', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->count();


        $data[0] = ['Nivel', 'Cantidad de estudiantes'];

        return View::make('course.statistics.materials', compact('course', 'data', 'totalMaterials'));
    }

    public function moduleReport($courseID)
    {
        $course = Course::with('modules')->findOrFail($courseID);

        $selectModules[''] = 'Seleccionar...';

        foreach ($course->modules as $module)
        {
            $selectModules[$module->id] = $module->name;
        }

        $data = null;
        if (Input::has('moduleID'))
        {
            $moduleID = Input::get('moduleID');
            $module = Module::where('course_id', $courseID)->findOrFail($moduleID);
            $totalQuizzes = $module->quizzes->count();
            $data = $module->report($totalQuizzes,true);
        }

        return View::make('course.statistics.module_report', compact('course', 'selectModules', 'data','module'));
    }

    public function downloadModuleReport($courseID)
    {
        $moduleID = Input::get('moduleID');

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
                    "Fecha de corte para este módulo: $module->end_date"
                ));

                $sheet->mergeCells('A2:F2');

                $sheet->prependRow(3, array(
                    "Fecha de generación de este reporte: ".date('Y-m-d H:i:s')
                ));

                $sheet->prependRow(4,[
                    "Total de estudiantes: ".sizeof($data)
                ]);

                $sheet->mergeCells('A4:F4');

                $sheet->mergeCells('A3:F3');

                $sheet->row(5, function($row) {

                    $row->setBackground('#428bca');
                    $row->setFontColor('#ffffff');
                    $row->setFontSize(12);
                    $row->setFontWeight('bold');

                });
            });

        })->download('xlsx');
    }

    public function quizzes($courseID)
    {
        $course = Course::findOrFail($courseID);

        $totalQuizzes = Quiz::whereHas('module', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->count();

        $predata[0] = ['Fecha', 'Evaluaciones resueltas', 'Evaluaciones intentadas'];

        $quizzesAttempts = QuizAttempt::whereHas('quiz', function ($q) use ($course)
        {
            $q->whereHas('module', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->get();


        $date = $course->start_date;
        $end_date = date('Y-m-d');

        $months = ['', '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr', '05' => 'May', '06' => 'Jun',
                       '07' => 'Jul', '08' => 'Ago', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'];

        while (strtotime($date) <= strtotime($end_date))
        {
            $auxDate = explode("-", $date);
            $predata[$date] = [$months[$auxDate[1]] . ' ' . $auxDate[2], 0, 0];
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        foreach ($quizzesAttempts as $quizzesAttempt)
        {
            $date = $quizzesAttempt->created_at->format('Y-m-d');

            if ($quizzesAttempt->grade >= $course->threshold)
            {
                $predata[$date][1] ++;
            }
            $predata[$date][2] ++;

        }
        $data = [];
        $i = 0;
        foreach ($predata as $row)
        {
            $data[$i] = $row;
            $i ++;

        }

        return View::make('course.statistics.quizzes', compact('course', 'data', 'totalQuizzes'));
    }

}