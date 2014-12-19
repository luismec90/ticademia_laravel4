<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index)
        {
            Topic::create([
                'id'          => $index,
                'course_id'   => 1,
                'user_id'     => rand(1, 12),
                'name'        => $faker->text(),
                'description' => $faker->text()
            ]);
        }
    }

}