<?php

class QuizzesController extends \BaseController {


    public function skip($curseID, $moduleID)
    {
        $quizID = Input::get('quiz_id');

        $module = Module::findOrFail($moduleID);

        $quiz = Quiz::where('module_id', $module->id)->find($quizID);

        if (!is_null($quiz) && is_null($quiz->approvedQuiz) && $quiz->prevQuizIsApproved() && $quiz->userQuizAttempts->count() )
        {
            $approvedQuiz = new ApprovedQuiz;
            $approvedQuiz->user_id = Auth::user()->id;
            $approvedQuiz->quiz_id = $quiz->id;
            $approvedQuiz->score = 0;
            $approvedQuiz->skipped = 1;
            $approvedQuiz->save();

            Flash::success('Evaluación saltada correctamente');
        } else
        {
            Flash::error('Por favor inténtalo nuevamente');
        }

        return Redirect::back();
    }
}