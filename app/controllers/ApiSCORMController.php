<?php

class ApiSCORMController extends \BaseController {


    public function LMSInitialize()
    {
        $quizId = Input::get('quiz_id');
        $quiz = Quiz::find($quizId);

        if (is_null($quiz))
            return 'error';

        $microDate = microtime();
        $ms = explode(' ', $microDate);
        $ms = round($ms[0] * 1000);
        $starDate = date('Y-m-d H:i:s') . '.' . $ms;

        $quizAttempt = new QuizAttempt;
        $quizAttempt->quiz_id = $quiz->id;
        $quizAttempt->user_id = Auth::user()->id;
        $quizAttempt->start_date = $starDate;
        $quizAttempt->save();

        $sessionName = Auth::user()->id . '-' . $quiz->id;
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

        $quiz = Quiz::find($quizId);

        if (is_null($quiz) || $grade == '')
            return 'error';

        $sessionName = Auth::user()->id . '-' . $quiz->id;
        $quizAttemptId = Session::get($sessionName);
        Session::forget($sessionName);

        $quizAttempt = QuizAttempt::find($quizAttemptId);
        $quizAttempt->grade = $grade;
        $quizAttempt->end_date = $endDate;

        if (is_null($quizAttempt))
            return 'error';

        if ($grade == 1)
        {
            $feedbackForUser = $A[rand(0, 4)] . $B[rand(0, 3)];
            $feedback = "Correcto";

            $this->bestTime($quiz, $quizAttempt->start_date, $quizAttempt->end_date);
        } else
        {
            $feedbackForUser = $C[rand(0, 3)] . $D[rand(0, 1)];
            $feedback = "Incorrecto";
        }


        $quizAttempt->feedback = $feedback;
        $quizAttempt->save();


        return $feedbackForUser;
    }

    private function bestTime($quiz, $start_date, $end_date)
    {
        $diff = DB::select(DB::raw("SELECT TIMESTAMPDIFF(MICROSECOND,'$start_date','$end_date')/1000000 AS value"));
        $diff = $diff[0]->value;

        if ($quiz->best_time == '' || $quiz->best_time > $diff)
        {
            $quiz->user_id = Auth::user()->id;
            $quiz->best_time = $diff;
            $quiz->save();
        }
    }
}