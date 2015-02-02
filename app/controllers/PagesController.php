<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {


    public function test()
    {

       //return View::make('emails.auth.hi', compact('courses'));

        Mail::send('emails.auth.hi', [], function ($message)
        {
            $message->to('luismec90@gmail.com')
                ->subject('Bienvenido!');
        });

    }

    public function enroll()
    {
        ini_set('max_execution_time', 300);

        $students = [['1017214613','Daniela Arango Ospina','darangoo@unal.edu.co'],[' 1036952857','Daniel Escudero Ospina','deescuderoo@unal.edu.co'],[' 1037629252','Manuel Alberto Ayaso','maayasob@unal.edu.co']];


        foreach ($students as $index => $row)
        {

            $student = User::where('dni', $row[0])->first();

            if (is_null($student))
            {
                /*$name = explode(" ", $row[1]);

                $firstName = "";
                $lastName = "";
                $i = 0;
                foreach ($name as $row2)
                {
                    if ($i < 2)
                        $firstName .= $row2 . " ";
                    else
                        $lastName .= $row2 . " ";

                    $i ++;
                }
                $firstName=trim($firstName);
                $lastName=trim($lastName);
        */
                $student = new User;

                $student->dni = $row[0];
                $student->first_name =$row[1];
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
                var_dump($row);

            }

            $student->courses()->sync([1 => [ 'level_id' => 10, 'role' => 2]]);

        }
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
