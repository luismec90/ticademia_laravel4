<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 40) as $index)
        {
            Topic::create([
                'id'          => $index,
                'course_id'   => 1,
                'user_id'     => rand(2, 12),
                'name'        => "Módulo: Geometría elemental, conjuntos y sistemas numéricos. Evaluación $index",
                'description' => $faker->text()
            ]);
        }
    }

}