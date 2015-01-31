<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $orden = 1;
        for ($i = 1; $i <= 20; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 1 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 1"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 21; $i <= 31; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 2 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 2"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 32; $i <= 46; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 3 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 3"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 47; $i <= 55; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 4 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 4"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 56; $i <= 65; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 5 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 5"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 66; $i <= 75; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 6 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 6"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 76; $i <= 85; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 7 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 7"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 86; $i <= 95; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 8 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 8"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 96; $i <= 105; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 9 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 9"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 106; $i <= 115; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 10 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 10"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 116; $i <= 125; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 11 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 11"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 126; $i <= 135; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 12 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 12"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 136; $i <= 145; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 13 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 13"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 146; $i <= 155; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 14 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 14"
            ]);
            $orden ++;
        }

        $orden = 1;
        for ($i = 156; $i <= 170; $i ++)
        {
            Topic::create([
                'id'          => $i,
                'course_id'   => 1,
                'user_id'     => 5,
                'name'        => "Módulo: 15 - Evaluación: $orden",
                'description' => "En este foro podrás exponer tus dudas respecto a la evaluación $orden del Módulo 15"
            ]);
            $orden ++;
        }
    }
}