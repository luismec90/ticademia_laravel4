<?php

class AchievementHelper {

    public static function achievement_primerEjercicio($user, $course)
    {
        $achievementID = 1;

        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievementID))//Si no tiene el logro para este curso
        {
            $module = Module::whereHas('quizzes', function ($q) use ($user)
            {
                $q->whereHas('approvedQuiz', function ($q) use ($user)
                {
                    $q->where('user_id', $user->id)
                        ->where('skipped', 0);
                });
            })->where('course_id', $course->id)->get();

            if ($module->count())
                AchievementHelper::giveAchievement($user, $course, $achievementID);
        }
    }

    public static function achievement_primeraParticipacionForo($user, $course)
    {
        $achievement_id = 6;

        if (AchievementHelper::dontHaveTheAchievement($user, $course, $achievement_id))//Si no tiene el logro para este curso
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

            if ($totalPosts > 0)// Si tiene mas de un pots darle el logro
            {
                AchievementHelper::giveAchievement($user, $course, $achievement_id);
            }
        }
    }

    public static function dontHaveTheAchievement($user, $course, $achievement_id)
    {
        $reachedAchievement = ReachedAchievement::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('achievement_id', $achievement_id)
            ->first();

        return is_null($reachedAchievement);
    }

    public static function giveAchievement($user, $course, $achievementID)
    {
        $reachedAchievement = new ReachedAchievement;
        $reachedAchievement->user_id = $user->id;
        $reachedAchievement->course_id = $course->id;
        $reachedAchievement->achievement_id = $achievementID;
        $reachedAchievement->save();

        AchievementHelper::setNotification($achievementID, $course->id);
    }

    public static function setNotification($achievementID, $courseID)
    {
        $achievement = Achievement::findOrFail($achievementID);

        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->title = 'Has ganado un nuevo logro';
        $notification->image = $achievement->imagePath();
        $notification->url = route('achievement_path', $courseID);
        $notification->body = "Felicitaciones! Has ganado el logro <b>{$achievement->name}</b>.";
        $notification->show_modal = 1;
        $notification->save();
    }

}