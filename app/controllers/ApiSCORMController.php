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

            $diff = DB::select(DB::raw("SELECT TIMESTAMPDIFF(MICROSECOND,'$quizAttempt->start_date','$quizAttempt->end_date')/1000000 AS value"));
            $diff = round($diff[0]->value, 3);

            $firstTimeApprovedQuiz = is_null($quiz->approvedQuiz);

            $this->bestTime($quiz, $diff);
            $this->approvedQuiz($quiz, $diff);
            $this->updateModuleUserScore($quiz);

            $quiz = Quiz::find($quiz->id);//Cargamos de nuevo el quiz para preguntar por ->approvedQuiz
            if ($firstTimeApprovedQuiz && $quiz->approvedQuiz->skipped == 0)
            {
                $feedbackForUser .= '<br><br> Acabas de ganar <b>' . $quiz->approvedQuiz->score . '  puntos</b> y tu tiempo fue de <b>' . $diff . ' segundos</b>';
            } else
            {
                $feedbackForUser .= '<br><br> Tu tiempo fue de <b>' . $diff . ' segundos</b>';
            }
            AchievementHelper::achievement_primerEjercicio(Auth::user(), $quiz->module->course);
        } else
        {
            $feedbackForUser = $C[rand(0, 3)] . $D[rand(0, 1)];
            $feedback = "Incorrecto";
        }


        $quizAttempt->feedback = $feedback;
        $quizAttempt->save();


        return $feedbackForUser;
    }

    private function bestTime($quiz, $diff)
    {
        if ($quiz->best_time == '' || $quiz->best_time > $diff)
        {
            $quiz->user_id = Auth::user()->id;
            $quiz->best_time = $diff;
            $quiz->save();
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
            ->sum('approved_quizzes.score');

        $moduleUser->save();
    }
}