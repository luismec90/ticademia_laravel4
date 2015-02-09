<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {


    public function test()
    {
       echo   $_SERVER['SERVER_NAME'];
    }

    public function enroll()
    {
        ini_set('max_execution_time', 300);

        $students = [['97071423054', 'Gallego Sepúlveda Milena', 'migallegose@unal.edu.co']];

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
                $notification->body = "Te recomendamos visitar la sección de recursos y leer el  archivo 'Tutorial para cálculos y redondeo' antes de resolver los ejercicios. <div class='btn-notification-hide'><br> <a class='btn btn-primary' target='_blank' href='http://ticademia.medellin.unal.edu.co/assets/tutorial.pdf'>Ver tutorial</a> </div>";
                $notification->show_modal = 1;
                $notification->save();

                $student->courses()->sync([1 => ['level_id' => 1, 'role' => 1]]);

            } else
            {
                var_dump($student);

            }
        }
    }

    public function log($userID)
    {
        $user = User::findOrFail($userID);

        Auth::login($user);

        return Redirect::route('module_path', [1, 1]);
    }

    public function duels($userID)
    {
        $course=Course::first();
        $user = User::findOrFail($userID);

        Auth::login($user);

        return View::make('pages.duel',compact('course'));
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
