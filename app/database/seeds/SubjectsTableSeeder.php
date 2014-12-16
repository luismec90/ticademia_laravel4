<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SubjectsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Subject::create([
            'id'                => 1,
            'name'              => 'Matemáticas Báscias',
            'description'       => 'Lorem...',
            'table_of_contents' => 'Lorem...',
            'language'          => 'español',
            'prerequisites'     => 'Lorem...'
        ]);
    }

}