<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReachedAchievementsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $achievementIDs = [1, 6, 7, 8, 9, 10, 11, 12, 13];

        foreach ($achievementIDs as $value)
        {
            ReachedAchievement::create([
                'user_id'        => 1,
                'course_id'      => 1,
                'achievement_id' => $value
            ]);

        }


    }

}