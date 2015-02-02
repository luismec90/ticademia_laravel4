<?php
use Illuminate\Support\Collection;

class PagesController extends BaseController {


    public function test()
    {

        echo date('Y-m-d H:i:s');

    }

    public function enroll()
    {
        ini_set('max_execution_time', 300);

        $students = [['MATEMÁTICAS BÁSICAS','1000001','1','CLASE TEORICA','MA-JU','06:00-08:00','David Santiago Correa C.','dscorreac@unal.edu.co','1.128.395.497'],['MATEMÁTICAS BÁSICAS','1000001','2','CLASE TEORICA','MI-VI','12:00-14:00','Jhon Edison Hinestroza','jhehinestrozara@unal.edu.co','98.552.696'],['MATEMÁTICAS BÁSICAS','1000001','4','CLASE TEORICA','MA-JU','10:00-12:00','EDGAR ARTURO RAMOS NAVARRETE','earamosn@unal.edu.co','79.292.147'],['MATEMÁTICAS BÁSICAS','1000001','6','CLASE TEORICA','MI-VI','10:00-12:00','William Mateus','wimateusav@unal.edu.co','1.110.480.931'],['MATEMÁTICAS BÁSICAS','1000001','7','CLASE TEORICA','MI-VI','08:00-10:00','Fernando Puerta Ortiz','fpuerta@unal.edu.co','19.076.825'],['MATEMÁTICAS BÁSICAS','1000001','8','CLASE TEORICA','MI-VI','06:00-08:00','Jhon Fredy Ruiz','jfruiz@unal.edu.co','71.370.949'],['MATEMÁTICAS BÁSICAS','1000001','9','CLASE TEORICA','MI-VI','14:00-16:00','Sigifredo De Jesus Herron Osorio','sherron@unal.edu.co','6.984.720'],['MATEMÁTICAS BÁSICAS','1000001','10','CLASE TEORICA','MA-JU','16:00-18:00','Sergio Andrés Narváez J.','sanarvaez@unal.edu.co','1.036.396.939'],['MATEMÁTICAS BÁSICAS','1000001','11','CLASE TEORICA','MI-VI','16:00-18:00','Javier Martinez Gonzalez','javmartinezgon@unal.edu.co','1.102.837.116'],['MATEMÁTICAS BÁSICAS','1000001','12','CLASE TEORICA','MA-JU','16:00-18:00','John Jader Mira Albanes','jjmira@unal.edu.co','8.013.110'],['MATEMÁTICAS BÁSICAS','1000001','13','CLASE TEORICA','MA-JU','18:00-20:00','Jose Gabriel Hernández Montiel','jghernandezm@unal.edu.co','1.064.985.348'],['MATEMÁTICAS BÁSICAS','1000001','14','CLASE TEORICA','MA-JU','12:00-14:00','EDGAR ARTURO RAMOS NAVARRETE','earamosn@unal.edu.co','79.292.147'],['MATEMÁTICAS BÁSICAS','1000001','15','CLASE TEORICA','MA-JU','14:00-16:00','Julio Cesar Morales Cuervo','jcmorale@unal.edu.co','3.454.766']];


        foreach ($students as $index => $row)
        {
            $row[8]=str_replace(".","",$row[8]);
            $student = User::where('dni', $row[8])->first();

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

                $student->dni = $row[8];
                $student->first_name =$row[6];
                $student->email = $row[7];
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
