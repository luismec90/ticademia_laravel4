<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SubjectsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Subject::create([
            'id'                => 1,
            'name'              => 'Matemáticas Básicas',
            'description'       => '',
            'table_of_contents' => '',
            'language'          => 'español',
            'prerequisites'     => ''
        ]);

    }

}