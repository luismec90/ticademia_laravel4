<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuizTypesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();


        QuizType::create([
            'id'    => 1,
            'name'  => 'Selección multiple',
            'value' => 250
        ]);

        QuizType::create([
            'id'    => 2,
            'name'  => 'Respuesta libre',
            'value' => 350
        ]);


        QuizType::create([
            'id'    => 3,
            'name'  => 'Desafio',
            'value' => 450
        ]);


    }

}