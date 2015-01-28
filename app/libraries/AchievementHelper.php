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
        $totalQuizzesBestTime = Quiz::whereHas('module', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->where('user_id', $user->id)
            ->count();

        if ($totalQuizzesBestTime == 15)
        {
            $achievementID = 21;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($totalQuizzesBestTime == 5)
        {
            $achievementID = 20;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($totalQuizzesBestTime == 1)
        {
            $achievementID = 14;

            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
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

    public static function achievement_materialesVistos($user, $course)
    {
        $totalViewedMaterials = MaterialUser::whereHas('material', function ($q) use ($course)
        {
            $q->whereHas('module', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->where('user_id', $user->id)
            ->select('material_id')
            ->distinct()
            ->get()
            ->count();

        $totalMaterials = Material::whereHas('module', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->count();

        if ($totalViewedMaterials == $totalMaterials)
        {
            $achievementID = 25;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }

        if ($totalViewedMaterials == 10)
        {
            $achievementID = 24;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($totalViewedMaterials == 5)
        {
            $achievementID = 23;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($totalViewedMaterials == 1)
        {
            $achievementID = 22;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }

    public static function achievement_videoUsuario($user, $course)
    {
        $materialsUser = DB::table('material_users')
            ->join('materials', 'materials.id', '=', 'material_users.material_id')
            ->join('modules', 'modules.id', '=', 'materials.module_id')
            ->where('modules.course_id', $course->id)
            ->groupBy('materials.id')
            ->selectRaw('materials.id material_id,ROUND(SUM(material_users.playback_time)/materials.duration*100,1) perctentage')
            ->get();

        $cont = 0;

        foreach ($materialsUser as $materialUser)
        {
            if ($materialUser->perctentage > 75)
                $cont ++;
        }


        if ($cont == 12)
        {
            $achievementID = 27;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($cont == 3)
        {
            $achievementID = 26;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }

    public static function achievement_valoracionesMateriales($user, $course)
    {
        $totalMaterials = Material::whereHas('module', function ($q) use ($course)
        {
            $q->where('course_id', $course->id);
        })->count();

        $totalUserReviews = Review::whereHas('material', function ($q) use ($course)
        {
            $q->whereHas('module', function ($q) use ($course)
            {
                $q->where('course_id', $course->id);
            });
        })->where('user_id', $user->id)->count();

        if ($totalUserReviews >= 8)
        {
            $achievementID = 30;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($totalUserReviews >= 4)
        {
            $achievementID = 29;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($totalUserReviews >= 1)
        {
            $achievementID = 28;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }

        if ($totalUserReviews == $totalMaterials)
        {
            $achievementID = 31;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }

    public static function achievement_meGustaTopicReply($user, $course, $topicReply)
    {
        $countLikes = $topicReply->likes()->where('user_id', '<>', $user->id)->count();

        if ($countLikes == 4)
        {
            $achievementID = 32;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($countLikes == 12)
        {
            $achievementID = 33;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }

    public static function achievement_meGustaWallMessages($user, $course, $wallMessage)
    {
        $countLikes = $wallMessage->likes()->where('user_id', '<>', $user->id)->count();

        if ($countLikes == 5)
        {
            $achievementID = 36;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($countLikes == 10)
        {
            $achievementID = 37;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }

    public static function achievement_wallMessages($user, $course)
    {
        $countPosts = WallMessage::where('course_id', $course->id)
            ->where('user_id', $user->id)->count();

        if ($countPosts == 1)
        {
            $achievementID = 34;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        } else if ($countPosts == 7)
        {
            $achievementID = 35;
            if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
            {
                AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
            }
        }
    }

    public static function achievement_timePlatformUse($user)
    {
        $courses = $user->courses;

        foreach ($courses as $course)
        {

            $totalTime = Connection::selectRaw('ROUND(SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at))/3600,1) total')
                ->where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->groupBy('user_id')
                ->get();
            if ($totalTime->count() > 0)
            {
                $totalTime = $totalTime[0]->total;

                if ($totalTime >= 72)
                {
                    $achievementID = 43;
                    if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
                    {
                        AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
                    }
                }
                if ($totalTime >= 36)
                {
                    $achievementID = 42;
                    if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
                    {
                        AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
                    }
                }
                if ($totalTime >= 24)
                {
                    $achievementID = 41;
                    if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
                    {
                        AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
                    }
                }
                if ($totalTime >= 12)
                {
                    $achievementID = 40;
                    if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
                    {
                        AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
                    }
                }
                if ($totalTime >= 6)
                {
                    $achievementID = 39;
                    if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
                    {
                        AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
                    }
                }
                if ($totalTime >= 3)
                {
                    $achievementID = 38;
                    if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
                    {
                        AchievementHelper::giveAchievement($user, $course, $achievementID);//La validación se hizo antes de invocar este método
                    }
                }
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

            AchievementHelper::setNotification($user, $achievementID, $course->id, $reachedAchievement->id);
        }
    }

    public static function setNotification($user, $achievementID, $courseID, $reachedAchievementID)
    {
        $achievement = Achievement::findOrFail($achievementID);

        $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->title = 'Has ganado un nuevo logro';
        $notification->image = $achievement->imagePath();
        $notification->url = route('achievement_path', $courseID);
        $notification->body = "Felicitaciones! Has ganado el logro: <b>{$achievement->name}</b>.<br> Descripción: {$achievement->description} <br><br> Recompensa: <b>{$achievement->reward} puntos</b>";
        $notification->reached_achievement_id = $reachedAchievementID;
        $notification->show_modal = 1;
        $notification->save();
    }
}