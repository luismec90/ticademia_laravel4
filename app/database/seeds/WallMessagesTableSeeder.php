<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class WallMessagesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index)
        {
            WallMessage::create([
                'id'        => $index,
                'course_id' => 1,
                'user_id'   => $index%7+1,
                'message'   => $faker->text(),
                'type'      => 'custom'
            ]);
        }
        foreach (range(1, 20) as $index)
        {
            WallMessage::create([
                'course_id'       => 1,
                'user_id'         => rand(1,12),
                'wall_message_id' =>  rand(1,50),
                'message'         => $faker->text(),
                'type'            => 'custom'
            ]);
        }
    }

}