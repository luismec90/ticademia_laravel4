<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class WallMessagesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index)
        {
            WallMessage::create([
                'id'        => $index,
                'course_id' => 1,
                'user_id'   => $index,
                'message'   => $faker->text(),
                'type'      => 'custom'
            ]);
        }
        WallMessage::create([
            'course_id'       => 1,
            'user_id'         => 2,
            'wall_message_id' => 1,
            'message'         => $faker->text(),
            'type'            => 'custom'
        ]);
    }

}