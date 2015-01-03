<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuizzesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 40; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 1,
                'quiz_type_id' => 3,
                'order'        => $i
            ]);
        }
    }

}