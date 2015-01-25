<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {

    public function test()
    {

        $course = Course::with('modules')->first();

        $data = DB::select("SELECT u.id,cu.group,u.dni,u.email,u.last_name,u.first_name FROM users u
JOIN course_user cu ON u.id=cu.user_id
WHERE cu.course_id=$course->id
AND cu.role=1
ORDER BY cu.group,u.last_name,u.first_name
");

        $data = Collection::make($data)->keyBy('id');



        foreach ($data as $row)
        {
            foreach ($course->modules as $module)
            {
                $index = "module_$module->id";
                $row->$index = '0';

            }
        }



        foreach ($course->modules as $module)
        {
            array_push($headerExcel, "Módulo $module->id");

            $r = DB::select("SELECT q.module_id,aq.user_id,ROUND(COUNT(aq.id)/40*100,2) percentage
                FROM approved_quizzes aq
                JOIN quizzes q ON aq.quiz_id=q.id
                WHERE aq.skipped=0
                    AND q.module_id=$module->id
                    AND aq.created_at<='$module->end_date'
                GROUP BY aq.user_id");

            foreach ($r as $r2)
            {
                $module = "module_$r2->module_id";
                $data[$r2->user_id]->$module = $r2->percentage;
            }

        }

        $data = json_decode(json_encode($data), true);

            Excel::create("Reporte TICademia", function ($excel) use ($data,$headerExcel,$course)
        {
            $excel->sheet('Hoja 1', function ($sheet) use ($data,$headerExcel,$course)
            {
                $sheet->fromArray($data);
                $sheet->row(1,$headerExcel);
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

        // return View::make('pages.test');
        //  $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/kAOm3APJopM');
        //  return strval($xml->xpath('//yt:duration[@seconds]')[0]->attributes()->seconds);

    }


    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }


}
