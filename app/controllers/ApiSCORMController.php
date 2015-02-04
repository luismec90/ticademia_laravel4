<?php

class ApiSCORMController extends \BaseController {


    public function LMSInitialize()
    {

        $quizId = Input::get('quiz_id');
        $quiz = Quiz::with('module', 'module.course')->find($quizId);

        if (is_null($quiz))
            return 'error';


        $microDate = microtime();
        $ms = explode(' ', $microDate);
        $ms = round($ms[0] * 1000);
        $starDate = date('Y-m-d H:i:s') . '.' . $ms;

        $sessionName = Auth::user()->id . '-' . $quiz->id;

        if (!Auth::user()->isStudent($quiz->module->course->id))
        {
            Session::put($sessionName, $starDate);

            return 'ok';
        }

        $quizAttempt = new QuizAttempt;
        $quizAttempt->quiz_id = $quiz->id;
        $quizAttempt->user_id = Auth::user()->id;
        $quizAttempt->start_date = $starDate;
        $quizAttempt->save();


        Session::put($sessionName, $quizAttempt->id);

        return 'ok';
    }

    public function LMSFinish()
    {
        dd(Input::all());
    }

    public function LMSSetValue()
    {
        dd(Input::all());
    }

    public function grade()
    {
        $microDate = microtime();
        $ms = explode(' ', $microDate);
        $ms = round($ms[0] * 1000);
        $endDate = date('Y-m-d H:i:s') . '.' . $ms;

        $A = ["Felicitaciones", "Enhorabuena", "Magnífico", "Perfecto", "Muy bien"];
        $B = [", tu respuesta es correcta", ", has acertado", ", lo hiciste sin errores", ", te has lucido con la respuesta"];

        $C = ["Lamentablemente", "Desafortunadamente", "Tendrás que esforzarte más", "Lo siento"];
        $D = [", la respuesta no es correcta", ", no has acertado"];

        $quizId = Input::get('quiz_id');
        $grade = Input::get('grade');

        $quiz = Quiz::with('module', 'module.course')->find($quizId);

        if (is_null($quiz) || $grade == '')
            return 'error1';

        if (!Auth::user()->isStudent($quiz->module->course->id))
        {
            $sessionName = Auth::user()->id . '-' . $quiz->id;
            $startDate = Session::get($sessionName);
            Session::forget($sessionName);

            if ($grade >= $quiz->module->course->threshold)
            {
                $diff = DB::select(DB::raw("SELECT ROUND(TIMESTAMPDIFF(MICROSECOND,'$startDate','$endDate')/1000000,3) AS value"));
                $diff = $diff[0]->value;
                $feedbackForUser = $A[rand(0, 4)] . $B[rand(0, 3)];
                $feedbackForUser .= '<br><br> Tu tiempo fue de <b>' . $diff . ' segundos</b> <img src="' . asset('assets/images/course/time.png') . '" width="10">';
            } else
            {
                $feedbackForUser = $C[rand(0, 3)] . $D[rand(0, 1)];
                $feedbackForUser .= $this->feedbackMaterials($quiz);
            }

            return $feedbackForUser;
        }

        $sessionName = Auth::user()->id . '-' . $quiz->id;
        $quizAttemptId = Session::get($sessionName);
        Session::forget($sessionName);

        $quizAttempt = QuizAttempt::find($quizAttemptId);

        if (is_null($quizAttempt))
            return 'error2';

        $quizAttempt->grade = $grade;
        $quizAttempt->end_date = $endDate;
        $quizAttempt->save();

        if ($grade >= $quiz->module->course->threshold)
        {
            $feedbackForUser = $A[rand(0, 4)] . $B[rand(0, 3)];
            $feedback = "Correcto";

            $diff = DB::select(DB::raw("SELECT ROUND(TIMESTAMPDIFF(MICROSECOND,'$quizAttempt->start_date','$quizAttempt->end_date')/1000000,3) AS value"));
            $diff = $diff[0]->value;

            $firstTimeApprovedQuiz = is_null($quiz->approvedQuiz);

            $this->bestTime($quiz, $diff);
            $this->approvedQuiz($quiz, $diff);
            $this->updateModuleUserScore($quiz);

            $quiz = Quiz::find($quiz->id);//Cargamos de nuevo el quiz para preguntar por ->approvedQuiz
            if ($firstTimeApprovedQuiz && $quiz->approvedQuiz->skipped == 0)
            {
                $feedbackForUser .= '<br><br> Acabas de ganar <b>' . $quiz->approvedQuiz->score . '  puntos</b> <img src="' . asset('assets/images/course/star.png') . '" width="17"> y tu tiempo fue de <b>' . $diff . ' segundos</b>  <img src="' . asset('assets/images/course/time.png') . '" width="10">';
            } else
            {
                $feedbackForUser .= '<br><br> Tu tiempo fue de <b>' . $diff . ' segundos</b>';
            }

            AchievementHelper::achievement_enLinea(Auth::user(), $quiz->module->course);

            $percentageCourse = $this->percentageCourse($quiz->module->course);

            AchievementHelper::achievement_percentageCourse(Auth::user(), $quiz->module->course, $percentageCourse);

            $this->checkLevel($quiz->module->course, $percentageCourse);
        } else
        {
            $feedbackForUser = $C[rand(0, 3)] . $D[rand(0, 1)];
            $feedback = "Incorrecto";

            $feedbackForUser .= $this->feedbackMaterials($quiz);
        }


        $quizAttempt->feedback = $feedback;
        $quizAttempt->save();


        return $feedbackForUser;
    }

    private function bestTime($quiz, $diff)
    {
        if ($quiz->best_time == '' || $quiz->best_time > $diff && $quiz->best_time > 0)
        {
            if ($quiz->user_id != null && !$quiz->user->isMe())
            {
                Mail::send('emails.notify', ['oldUser' => $quiz->user, 'quiz' => $quiz, 'newUser' => Auth::user(), 'oldBestTime' => $quiz->best_time, 'newBestTime' => $diff], function ($message) use ($quiz)
                {
                    $message->to($quiz->user->email, $quiz->user->fullName())
                        ->bcc('luismec90@gmail.com', 'Luis Montoya')
                        ->subject('TICademia');
                });
            }

            $quiz->user_id = Auth::user()->id;
            $quiz->best_time = $diff;
            $quiz->save();

            AchievementHelper::achievement_mejorTiempo(Auth::user(), $quiz->module->course);
        }
    }

    private function approvedQuiz($quiz, $diff)
    {
        if (is_null($quiz->approvedQuiz))
        {
            $approvedQuiz = new ApprovedQuiz;
            $approvedQuiz->user_id = Auth::user()->id;
            $approvedQuiz->quiz_id = $quiz->id;
            $approvedQuiz->score = $this->calculateQuizScore($quiz);
            $approvedQuiz->best_time = $diff;
            $approvedQuiz->save();
        } else
        {
            if ($quiz->approvedQuiz->best_time > $diff || $quiz->approvedQuiz->best_time == null)
            {
                $quiz->approvedQuiz->best_time = $diff;
                $quiz->approvedQuiz->save();
            }
        }
    }

    private function calculateQuizScore($quiz)
    {
        $minValue = 150;
        $maxValue = $quiz->quizType->value;
        $score = $maxValue - 10 * ($quiz->userQuizAttempts->count() - 1);

        return MAX($minValue, $score);
    }

    private function updateModuleUserScore($quiz)
    {
        $moduleUser = ModuleUser::where('user_id', Auth::user()->id)
            ->where('module_id', $quiz->module->id)
            ->first();

        if (is_null($moduleUser))
        {
            $moduleUser = new ModuleUser;
            $moduleUser->user_id = Auth::user()->id;
            $moduleUser->module_id = $quiz->module->id;
        }

        $moduleUser->score = DB::table('approved_quizzes')
            ->join('quizzes', 'quizzes.id', '=', 'approved_quizzes.quiz_id')
            ->where('quizzes.module_id', $quiz->module->id)
            ->where('approved_quizzes.user_id', Auth::user()->id)
            ->sum('approved_quizzes.score');

        $moduleUser->save();
    }

    private function checkLevel($course, $percentage)
    {


        if ($percentage == 100)
        {
            $level = 9; //  $level = 10 -> Logro: Dios de la sapiencia: 3 cursos completos
        } elseif ($percentage > 90)
        {
            $level = 9;
        } else if ($percentage > 80)
        {
            $level = 8;
        } else if ($percentage > 65)
        {
            $level = 7;
        } else if ($percentage > 50)
        {
            $level = 6;
        } else if ($percentage > 35)
        {
            $level = 5;
        } else if ($percentage > 20)
        {
            $level = 4;
        } else if ($percentage > 10)
        {
            $level = 3;
        } else if ($percentage > 0)
        {
            $level = 2;
        } else
        {
            $level = 1;
        }

        if (Auth::user()->courses->find($course->id)->pivot->level_id != $level)
        {
            Auth::user()->courses()->updateExistingPivot($course->id, ['level_id' => $level]);

            $level = Level::findOrFail($level);

            $historicalLevel = new HistoricalLevel;
            $historicalLevel->course_id = $course->id;
            $historicalLevel->user_id = Auth::user()->id;
            $historicalLevel->level_id = $level->id;
            $historicalLevel->save();

            $notification = new Notification;
            $notification->user_id = Auth::user()->id;
            $notification->title = 'Cambio de nivel';
            $notification->image = $level->imagePath(Auth::user()->gender);
            $notification->body = "Felicitaciones! Has alcanzado el nivel <b>{$level->name}</b>.";
            $notification->show_modal = 1;
            $notification->save();
        }
    }

    private function percentageCourse($course)
    {
        $totalApprovedQuizzes = Quiz::whereHas('module', function ($q) use ($course)
        {
            $q->whereHas('course', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->whereHas('approvedQuiz', function ($q)
        {
            $q->where('user_id', Auth::user()->id)
                ->where('skipped', 0);
        })->count();

        $totalQuizzes = Quiz::whereHas('module', function ($q) use ($course)
        {
            $q->whereHas('course', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->count();


        return round($totalApprovedQuizzes / $totalQuizzes * 100, 2);
    }

    private function feedbackMaterials($quiz)
    {
        $feedbackForUser = "";
        if ($quiz->materials->count() > 0)
        {
            $feedbackForUser .= "<br><br>Te recomendamos revisar el siguiente material:<ul>";
            foreach ($quiz->materials as $material)
            {
                $feedbackForUser .= "<li> <a class='link video-launcher' data-id='$material->id'  data-name='$material->name' data-url='$material->url'>$material->name</a></li>";
            }
            $feedbackForUser .= "</ul>";
        }

        return $feedbackForUser;
    }
}