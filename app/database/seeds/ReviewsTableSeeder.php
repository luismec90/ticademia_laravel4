<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index)
        {
            Review::create([
                'user_id'     => rand(1, 14),
                'material_id' => rand(1, 20),
                'rating'      => rand(1, 10) * 0.5,
                'comment'     => rand(0, 2) ? '' : $faker->text(),
            ]);
        }

        foreach (Material::all() as $material)
        {
            $material->recalculateRating();
        }
    }

}