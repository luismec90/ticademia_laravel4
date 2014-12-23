<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuizzesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Quiz::create([
            'id'        => 1,
            'module_id' => 1,
            'order'     => 1
        ]);

        Quiz::create([
            'id'        => 2,
            'module_id' => 1,
            'order'     => 2
        ]);

        Quiz::create([
            'id'        => 3,
            'module_id' => 1,
            'order'     => 3
        ]);

        Quiz::create([
            'id'        => 4,
            'module_id' => 1,
            'order'     => 4
        ]);
    }

}