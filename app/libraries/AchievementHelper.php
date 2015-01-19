<?php

class AchievementHelper {

    public static function achievement_enLinea($user, $course)
    {


        $quizAttempts = QuizAttempt::whereHas('quiz', function ($q) use ($course)
        {
            $q->whereHas('module', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get();


        $achievementID = 13;
        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {
            $dontRepeatQuiz = [];

            $quizAttemptApproved = $quizAttempts->take(10)->filter(function ($quizAttempt) use ($course, &$dontRepeatQuiz)
            {
                if (in_array($quizAttempt->quiz_id, $dontRepeatQuiz))
                {
                    return false;

                } else
                {
                    array_push($dontRepeatQuiz, $quizAttempt->quiz_id);

                    return $quizAttempt->grade >= $course->threshold;
                }
            });

            if ($quizAttemptApproved->count() >= 10)
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);

                return;
            }
        }

        $achievementID = 12;
        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {

            $dontRepeatQuiz = [];

            $quizAttemptApproved = $quizAttempts->take(5)->filter(function ($quizAttempt) use ($course, &$dontRepeatQuiz)
            {
                if (in_array($quizAttempt->quiz_id, $dontRepeatQuiz))
                {
                    return false;

                } else
                {
                    array_push($dontRepeatQuiz, $quizAttempt->quiz_id);

                    return $quizAttempt->grade >= $course->threshold;
                }
            });

            if ($quizAttemptApproved->count() >= 5)
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);

                return;
            }
        }


        $achievementID = 11;
        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {

            $dontRepeatQuiz = [];

            $quizAttemptApproved = $quizAttempts->take(3)->filter(function ($quizAttempt) use ($course, &$dontRepeatQuiz)
            {
                if (in_array($quizAttempt->quiz_id, $dontRepeatQuiz))
                {
                    return false;

                } else
                {
                    array_push($dontRepeatQuiz, $quizAttempt->quiz_id);

                    return $quizAttempt->grade >= $course->threshold;
                }
            });

            if ($quizAttemptApproved->count() >= 3)
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);

                return;
            }
        }
    }

    public static function achievement_primeraParticipacionForo($user, $course)
    {
        $achievementID = 6;

        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {
            $topics = Topic::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->get();

            $replies = TopicReply::whereHas('topic', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            })->where('user_id', $user->id)
                ->get();

            $totalPosts = $topics->count() + $replies->count();

            if ($totalPosts > 0)// Si tiene al menos una entradas en el foro darle el logro
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);
            }
        }
    }

    public static function achievement_muyParticipativo($user, $course)
    {
        $achievementID = 9;

        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {
            $topics = Topic::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->get();

            $replies = TopicReply::whereHas('topic', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            })->where('user_id', $user->id)
                ->get();

            $totalPosts = $topics->count() + $replies->count();

            if ($totalPosts >= 5) // Si tiene 5 o mas entradas en el foro darle el logro
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);
            }
        }
    }

    public static function achievement_superParticipativo($user, $course)
    {
        $achievementID = 10;

        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {
            $topics = Topic::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->get();

            $replies = TopicReply::whereHas('topic', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            })->where('user_id', $user->id)
                ->get();

            $totalPosts = $topics->count() + $replies->count();

            if ($totalPosts >= 20) // Si tiene 10 o mas entradas en el foro darle el logro
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);
            }
        }
    }

    public static function achievement_mejorTiempo($user, $course)
    {
        $achievementID = 14;

        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {
            AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
        }
    }

    public static function achievement_percentageCourse($user, $course, $percentageCourse)
    {
        if ($percentageCourse == 100)
        {
            $achievementID = 19;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }

        } else if ($percentageCourse >= 75)
        {
            $achievementID = 18;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($percentageCourse >= 60)
        {
            $achievementID = 17;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($percentageCourse >= 40)
        {
            $achievementID = 16;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($percentageCourse >= 25)
        {
            $achievementID = 15;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }


    public static function dontHaveTheAchievement($user, $course, $achievementID)
    {
        $reachedAchievement = ReachedAchievement::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('achievement_id', $achievementID)
            ->first();

        return is_null($reachedAchievement);
    }

    public static function giveAchievement($user, $course, $achievementID)
    {
        if ($user->isStudent($course->id))
        {
            $reachedAchievement = new ReachedAchievement;
            $reachedAchievement->user_id = $user->id;
            $reachedAchievement->course_id = $course->id;
            $reachedAchievement->achievement_id = $achievementID;
            $reachedAchievement->save();

            AchievementHelper::setNotification($achievementID, $course->id, $reachedAchievement->id);
        }
    }

    public static function setNotification($achievementID, $courseID, $reachedAchievementID)
    {
        $achievement = Achievement::findOrFail($achievementID);

        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->title = 'Has ganado un nuevo logro';
        $notification->image = $achievement->imagePath();
        $notification->url = route('achievement_path', $courseID);
        $notification->body = "Felicitaciones! Has ganado el logro: <b>{$achievement->name}</b>.";
        $notification->reached_achievement_id = $reachedAchievementID;
        $notification->show_modal = 1;
        $notification->save();
    }
}