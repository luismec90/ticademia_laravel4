<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {


    public function test()
    {

        $course = Course::first();

        $students = $course->users()->where('role', 1)
            ->where('user_id', '=', 1)
            ->get()->lists('email');

        array_push($students, 'luismec90@gmail.com');
        array_push($students, 'lfmontoyag@unal.edu.co');



        //return View::make('emails.auth.hi', compact('courses'));

        Mail::send('emails.auth.hi', [], function ($message) use ($students)
        {
            $message->to('soporte.ticademia@gmail.com')
                ->bcc($students)
                ->subject('Bienvenido!');
        });

        return View::make('emails.auth.hi', compact('courses'));

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

    public function home()
    {
        return View::make('pages.home');
    }

    public function terms()
    {
        return View::make('pages.terms');
    }


}
