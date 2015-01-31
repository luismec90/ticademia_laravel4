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
        for ($i = 32; $i <= 46; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 3,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;

        for ($i = 47; $i <=55 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 4,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 56; $i <=65 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 5,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 66; $i <=75 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 6,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 76; $i <=85 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 7,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 86; $i <=95 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 8,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 96; $i <=105 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 9,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 106; $i <=115 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 10,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 116; $i <=125 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 11,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 126; $i <=135 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 12,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 136; $i <=145 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 13,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 146; $i <=155 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 14,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }

        $orden = 1;
        for ($i = 156; $i <=170 ; $i ++)
        {
            Quiz::create([
                'id'           => $i,
                'module_id'    => 15,
                'quiz_type_id' => 3,
                'topic_id'     => $i,
                'order'        => $orden ++
            ]);
        }
    }

}