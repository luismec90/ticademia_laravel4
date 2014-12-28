<?php

class Achievement {

    public static function haveTheAchievement($user, $course, $achievement_id)
    {
        $reachedAchievement = ReachedAchievement::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('achievement_id', $achievement_id)
            ->first();

        return is_null($reachedAchievement);
    }

    public static function achievement_primeraParticipacionForo($user, $course)
    {

    }
}