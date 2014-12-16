<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        User::create([
            'nombres' => 'Luis Fernando',
            'apellidos' => 'Montoya Gómez',
            'fecha_nacimiento'=>'1990-02-22',
            'sexo' => 'm',
            'email' => 'luismec90@gmail.com',
            'imagen' => 'default.png',
            'password' => Hash::make("123"),
            'activo' => 1
        ]);

        foreach (range(1, 10) as $index)
        {
            User::create([
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'fecha_nacimiento'=>$faker->dateTime(),
                'sexo' => 'm',
                'email' => $faker->email,
                'imagen' => 'default.png',
                'password' => Hash::make("123"),
                'activo' => 1
            ]);
        }
    }

}