<?php

class AchievementHelper {

    public static function dontHaveTheAchievement($user, $course, $achievement_id)
    {
        $reachedAchievement = ReachedAchievement::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('achievement_id', $achievement_id)
            ->first();

        return is_null($reachedAchievement);
    }

    public static function giveAchievement($user, $course, $achievement_id)
    {
        $reachedAchievement = new ReachedAchievement;
        $reachedAchievement->user_id = $user->id;
        $reachedAchievement->course_id = $course->id;
        $reachedAchievement->achievement_id = $achievement_id;
        $reachedAchievement->save();
    }

    public static function achievement_primeraParticipacionForo($user, $course)
    {
        $achievement_id = 1;

        if (Achievement::dontHaveTheAchievement($user, $course, $achievement_id))//Si no tiene el logro para este curso
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
                Achievement::giveAchievement($user, $course, $achievement_id);
            }
        }
    }


}