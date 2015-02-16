<?php

use Illuminate\Support\Collection;

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

        $predata2[0] = ['Fecha', 'Cantidad de conexiones por día'];


        $date = $course->start_date;
        $end_date = date('Y-m-d');

        $months = ['', '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr', '05' => 'May', '06' => 'Jun',
                       '07' => 'Jul', '08' => 'Ago', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'];

        while (strtotime($date) <= strtotime($end_date))
        {
            $auxDate = explode("-", $date);
            $predata2[$date] = [$months[$auxDate[1]] . ' ' . $auxDate[2], 0];
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        $connections = $connections = DB::table('connections')->where('course_id', $course->id)
            ->selectRaw("DATE_FORMAT(created_at,'%Y-%m-%d') day,COUNT(distinct(user_id)) total")
            ->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '>=', $course->start_date)
            ->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '<=', $course->end_date)
            ->groupBy('day')
            ->get();


        foreach ($connections as $connection)
        {
            $date = $connection->day;

            $predata2[$date][1] += $connection->total;

        }

        $data2 = [];
        $i = 0;
        foreach ($predata2 as $row)
        {
            $data2[$i] = $row;
            $i ++;
        }

        $data3[0] = ['Hora', 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado',];

        for ($i = 1; $i <= 24; $i ++)
        {
            $data3[$i] = [$i - 1, 0, 0, 0, 0, 0, 0, 0];

        }

        $connections = DB::table('connections')->where('course_id', $course->id)
            ->selectRaw('DAYOFWEEK(created_at) day,HOUR(created_at) hour,COUNT(distinct(user_id)) total')
            ->groupBy('day', 'hour')
            ->get();


        foreach ($connections as $connection)
        {

            $data3[$connection->hour + 1][$connection->day] = (int) $connection->total;

        }

        /*------*/


        $levels = Level::orderBy('id')->lists('name');

        $predata4[0] = array_merge(['Fecha'], $levels);


        $date = $course->start_date;

        $end_date = date('Y-m-d');

        $months = ['', '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr', '05' => 'May', '06' => 'Jun',
                       '07' => 'Jul', '08' => 'Ago', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'];

        $totalLevels = sizeof($levels);


        while (strtotime($date) <= strtotime($end_date))
        {
            $auxDate = explode("-", $date);

            $predata4[$date][0] = $months[$auxDate[1]] . ' ' . $auxDate[2];


            for ($i = 1; $i <= $totalLevels; $i ++)
            {
                $predata4[$date][$i] = 0;
            }
            $predata4[$date][1] = $totalStudents;

            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }


        $historicalLevelsPerUser = DB::table('users')
            ->join('course_user', 'users.id', '=', 'course_user.user_id')
            ->join('historical_levels', 'users.id', '=', 'historical_levels.user_id')
            ->selectRaw("DATE_FORMAT(historical_levels.created_at,'%Y-%m-%d') day,users.id,historical_levels.level_id")
            ->where(DB::raw("DATE_FORMAT(historical_levels.created_at,'%Y-%m-%d')"), '>=', $course->start_date)
            ->where(DB::raw("DATE_FORMAT(historical_levels.created_at,'%Y-%m-%d')"), '<=', $course->end_date)
            ->groupBy('users.id', 'day', 'historical_levels.level_id')
            ->get();


        $flag = true;
        $userFlag = - 1;
        $t = sizeof($historicalLevelsPerUser);

        for ($i = 0; $i < $t; $i ++)
        {
            if ($flag)
            {
                $userFlag = $historicalLevelsPerUser[$i]->id;
                $prevDate = $historicalLevelsPerUser[$i]->day;
                $levelID = 2;
                $predata4[$prevDate][$levelID] ++;
                $predata4[$prevDate][1] --;
                $flag = false;

                $prevDate = date("Y-m-d", strtotime("+1 day", strtotime($prevDate)));

                while ($prevDate <= $end_date)
                {
                    //  echo "Para el usuario $row->id en la fecha $prevDate <br>";
                    $predata4[$prevDate][$levelID] ++;
                    $predata4[$prevDate][1] --;

                    $prevDate = date("Y-m-d", strtotime("+1 day", strtotime($prevDate)));
                }

            } else
            {
                if ($userFlag != $historicalLevelsPerUser[$i]->id)
                {
                    $userFlag = $historicalLevelsPerUser[$i]->id;
                    $prevDate = $historicalLevelsPerUser[$i]->day;
                    $levelID = 2;
                }

                while ($prevDate <= $historicalLevelsPerUser[$i]->day)
                {
                    $predata4[$prevDate][$levelID] ++;
                    $predata4[$prevDate][1] --;

                    $prevDate = date("Y-m-d", strtotime("+1 day", strtotime($prevDate)));
                }

                if (isset($historicalLevelsPerUser[$i + 1]) && $historicalLevelsPerUser[$i + 1]->id != $userFlag)
                {
                    while ($prevDate <= $end_date)
                    {
                        $predata4[$prevDate][$levelID] ++;
                        $predata4[$prevDate][1] --;

                        $prevDate = date("Y-m-d", strtotime("+1 day", strtotime($prevDate)));
                    }
                }

                $levelID ++;
            }
        }

        $data4 = [];
        $totalLevels = sizeof($levels);
        $i = 0;

        foreach ($predata4 as $row)
        {

            $data4[$i] = $row;
            if ($i > 0)
            {
                for ($j = 1; $j <= $totalLevels; $j ++)
                {
                    $data4[$i][$j] = round($data4[$i][$j] / $totalStudents * 100, 1);
                }
            }
            $i ++;

        }

        /** ----------------- */

        $predata5[0] = ['Fecha', 'Cantidad de duelos por día'];


        $date = $course->start_date;
        $end_date = date('Y-m-d');


        while (strtotime($date) <= strtotime($end_date))
        {
            $auxDate = explode("-", $date);
            $predata5[$date] = [$months[$auxDate[1]] . ' ' . $auxDate[2], 0];
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        $duels = DB::table('duels')->where('course_id', $course->id)
            ->selectRaw("DATE_FORMAT(created_at,'%Y-%m-%d') day,COUNT(id) total")
            ->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '>=', $course->start_date)
            ->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '<=', $course->end_date)
            ->groupBy('day')
            ->get();


        foreach ($duels as $duel)
        {
            $date = $duel->day;

            $predata5[$date][1] += $duel->total;

        }

        $data5 = [];
        $i = 0;
        foreach ($predata5 as $row)
        {
            $data5[$i] = $row;
            $i ++;
        }

        /*-------------*/


        $data6 = [['Resultado del duelo', 'Cantidad de duelos'],
            ["Duelos ganados por el retador", Duel::where('course_id', $course->id)->whereNotNull('winner_user_id')->whereRaw('defiant_user_id=winner_user_id')->count()],
            ["Duelos ganados por el retado", Duel::where('course_id', $course->id)->whereNotNull('winner_user_id')->whereRaw('opponent_user_id=winner_user_id')->count()],
            ["Empates", Duel::where('course_id', $course->id)->whereNull('winner_user_id')->count()],
        ];



        return View::make('course.statistics.students', compact('course', 'data', 'data2', 'data3', 'data4', 'data5', 'data6', 'totalStudents'));
    }

    public function materials($courseID)
    {
        $course = Course::findOrFail($courseID);
        $totalMaterials = Material::whereHas('module', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->count();

        $predata[0] = ['Fecha', 'Cantidad de visitas', 'Porcentaje promedio de reproducción (%)'];
        $predata2[0] = ['Fecha', 'Cantidad de visitas'];


        $date = $course->start_date;
        $end_date = date('Y-m-d');

        $months = ['', '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr', '05' => 'May', '06' => 'Jun',
                       '07' => 'Jul', '08' => 'Ago', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'];

        while (strtotime($date) <= strtotime($end_date))
        {
            $auxDate = explode("-", $date);
            $predata[$date] = [$months[$auxDate[1]] . ' ' . $auxDate[2], 0, 0];
            $predata2[$date] = [$months[$auxDate[1]] . ' ' . $auxDate[2], 0];
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        $viewedVideos = MaterialUser::with('material')
            ->whereHas('material', function ($q) use ($course)
            {
                $q->where('type', 'video')->whereHas('module', function ($q) use ($course)
                {
                    $q->where('course_id', $course->id);
                });
            })
            ->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '>=', $course->start_date)
            ->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '<=', $course->end_date)
            ->get();

        foreach ($viewedVideos as $video)
        {
            $date = $video->created_at->format('Y-m-d');

            $predata[$date][1] ++;

            $predata[$date][2] += $video->playback_time / $video->material->duration * 100;
        }

        $data = [];
        $i = 0;
        foreach ($predata as $row)
        {
            $data[$i] = $row;
            if ($data[$i][1] > 0)
            {
                $data[$i][2] = round($data[$i][2] / $data[$i][1], 1);
            }
            $i ++;

        }

        $viewedPDFs = MaterialUser::with('material')
            ->whereHas('material', function ($q) use ($course)
            {
                $q->where('type', 'pdf')->whereHas('module', function ($q) use ($course)
                {
                    $q->where('course_id', $course->id);
                });
            })->get();

        foreach ($viewedPDFs as $pdf)
        {
            $date = $pdf->created_at->format('Y-m-d');

            $predata[$date][1] ++;

        }

        $data2 = [];
        $i = 0;
        foreach ($predata2 as $row)
        {
            $data2[$i] = $row;

            $i ++;

        }


        return View::make('course.statistics.materials', compact('course', 'data', 'data2', 'totalMaterials'));
    }

    public function moduleReport($courseID)
    {
        $course = Course::with('modules')->findOrFail($courseID);

        $modules = Input::get('modules', []);

        $allModules = Input::get('allModules', false);

        if ($allModules || !is_array($modules))
        {
            $modules = $course->modules->lists('id');
        }
        $data = null;

        if (!empty($modules))
        {
            $data = $this->getReport($course, $modules);
        }

        return View::make('course.statistics.students_report', compact('course', 'data', 'modules'));
    }

    public function downloadModuleReport($courseID)
    {
        $course = Course::with('modules')->findOrFail($courseID);

        $modules = Input::get('modules', []);

        $allModules = Input::get('allModules', false);

        if ($allModules || !is_array($modules))
        {
            $modules = $course->modules->lists('id');
        }
        $data = null;

        if (empty($modules))
        {
            Flash::error('Por favor selecciona un móduloi');

            return Redirect::back();

        }
        $headerExcel = ['Grupo', 'DNI', 'Correo', 'Apellidos', 'Nombres'];
        $data = $this->getReport($course, $modules, $headerExcel);

        $data = json_decode(json_encode($data), true);

        Excel::create("Reporte {$course->subject->name}", function ($excel) use ($data, $headerExcel, $course)
        {
            $excel->sheet('Hoja 1', function ($sheet) use ($data, $headerExcel, $course)
            {
                $sheet->fromArray($data);
                $sheet->row(1, $headerExcel);
                $sheet->prependRow(1, array(
                    "Curso: {$course->subject->name}"
                ));

                $sheet->mergeCells('A1:F1');

                $sheet->prependRow(2, array(
                    "Fecha de generación de este reporte: " . date('Y-m-d H:i:s')
                ));

                $sheet->prependRow(3, [
                    "Total de estudiantes matriculados: " . sizeof($data)
                ]);

                $sheet->mergeCells('A2:F2');

                $sheet->mergeCells('A3:F3');

                $sheet->row(4, function ($row)
                {
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

        return $course;

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

    private function getReport($course, $modules, &$headerExcel = [])
    {

        $data = DB::select("SELECT u.id,cu.group,u.dni,u.email,u.last_name,u.first_name FROM users u
                            JOIN course_user cu ON u.id=cu.user_id
                            WHERE cu.course_id=$course->id
                            AND cu.role=1
                            ORDER BY cu.group,u.last_name,u.first_name");

        $data = Collection::make($data)->keyBy('id');

        foreach ($data as $row)
        {
            foreach ($modules as $moduleID)
            {
                $index = "module_$moduleID";
                $row->$index = '0';

                if (!empty($headerExcel))
                    unset($row->id);
            }
        }

        foreach ($modules as $moduleID)
        {
            if (!empty($headerExcel))
                array_push($headerExcel, "Módulo $moduleID");

            $module = Module::findOrFail($moduleID);

            $r = DB::select("SELECT q.module_id,aq.user_id,ROUND(COUNT(aq.id)/{$module->quizzes->count()}*100,2) percentage
                            FROM approved_quizzes aq
                            JOIN quizzes q ON aq.quiz_id=q.id
                            JOIN modules m ON m.id=$moduleID
                            WHERE aq.skipped=0
                            AND q.module_id=$moduleID
                            AND aq.created_at<=m.end_date
                            GROUP BY aq.user_id");

            foreach ($r as $r2)
            {
                $module = "module_$r2->module_id";
                $data[$r2->user_id]->$module = $r2->percentage;
            }
        }

        return $data;
    }

}