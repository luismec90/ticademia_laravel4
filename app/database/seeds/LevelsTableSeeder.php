<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class LevelsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 8) as $index)
        {
            Level::create([
                'id'          => $index,
                'name'        => $faker->text(20),
                'image'       => $faker->text(15),
                'description' => $faker->text(50),
            ]);
        }
    }

}