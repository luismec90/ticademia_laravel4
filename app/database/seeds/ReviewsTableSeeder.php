<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index)
        {
            Review::create([
                'user_id'     => rand(1, 14),
                'material_id' => rand(1, 4),
                'rating'      => rand(1, 10),
                'comment'     => $faker->text(),
            ]);
        }
    }

}