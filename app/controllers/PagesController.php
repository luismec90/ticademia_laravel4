<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {


    public function test()
    {
        $course = Course::first();

        $totalStudents = $course->users()
            ->where('role', 1)
            ->count();

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

        $date = $course->start_date;
        $end_date = date('Y-m-d');

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

        return $predata4;
    }

    public function enroll()
    {
        ini_set('max_execution_time', 300);

        $students = [['3438502', 'Cabarcas Jaramillo Daniel', 'dcabarc@unal.edu.co']];


        foreach ($students as $index => $row)
        {
            $student = User::where('dni', $row[0])->first();

            if (is_null($student))
            {
                $name = explode(" ", $row[1]);

                $firstName = "";
                $lastName = "";
                $i = 0;
                foreach ($name as $row2)
                {
                    if ($i < 2)
                        $lastName .= $row2 . " ";
                    else
                        $firstName .= $row2 . " ";

                    $i ++;
                }
                $firstName = trim($firstName);
                $lastName = trim($lastName);

                $student = new User;

                $student->dni = $row[0];
                $student->first_name = $firstName;
                $student->last_name = $lastName;
                $student->email = $row[2];
                $student->avatar = 'default.png';
                $student->password = Hash::make($student->dni);
                $student->confirmed = 1;
                $student->gender = 'm';
                $student->save();

                $notification = new Notification;
                $notification->user_id = $student->id;
                $notification->title = 'Importante!';
                $notification->image = 'http://ticademia.medellin.unal.edu.co/assets/images/course/alert.png ';
                $notification->url = 'http://ticademia.medellin.unal.edu.co/assets/tutorial.pdf';
                $notification->body = "Te recomendamos visitar la sección de recursos y leer el  archivo 'Tutorial para cálculos y redondeo' antes de resolver los ejercicios. <div class='btn-notification-hide'><br> <a class='btn btn-primary' target='_blank' href='http://localhost/assets/tutorial.pdf'>Ver tutorial</a> </div>";
                $notification->show_modal = 1;
                $notification->save();

            } else
            {
                var_dump($student);

            }

            $student->courses()->sync([1 => ['level_id' => 10, 'role' => 2]]);

        }
    }

    public function log($userID)
    {
        $user = User::findOrFail($userID);

        Auth::login($user);

        return Redirect::route('module_path', [1, 1]);
    }

    public function duels()
    {
        return View::make('pages.duel');
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
