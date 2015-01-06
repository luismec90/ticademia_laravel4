<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class LevelsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();


        Level::create([
            'id'          => 1,
            'name'        => 'Zombie',
            'image'       => '1.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 2,
            'name'        => 'Principiante',
            'image'       => '2.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 3,
            'name'        => 'Pupilo',
            'image'       => '3.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 4,
            'name'        => 'Aprendiz',
            'image'       => '4.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 5,
            'name'        => 'Iniciado',
            'image'       => '5.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 6,
            'name'        => 'Conocedor',
            'image'       => '6.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 7,
            'name'        => 'Maestro',
            'image'       => '7.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 8,
            'name'        => 'Sabio',
            'image'       => '8.png',
            'description' => 'Lorem ipsum...',
        ]);
        Level::create([
            'id'          => 9,
            'name'        => 'Erudito',
            'image'       => '9.png',
            'description' => 'Lorem ipsum...',
        ]);

        Level::create([
            'id'          => 10,
            'name'        => 'Dios de la Sapiensa',
            'image'       => '10.png',
            'description' => 'Lorem ipsum...',
        ]);
    }
}