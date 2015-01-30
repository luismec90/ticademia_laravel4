<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuizzesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $orden = 1;
        for ($i = 1; $i <= 20; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 1,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 21; $i <= 31; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 2,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 32; $i <= 40; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 3,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }
    }

}