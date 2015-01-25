<?php

// Composer: 'fzaninotto/faker': 'v1.3.0'
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        User::create([
            'id'         => 1,
            'first_name' => 'Luis Fernando',
            'last_name'  => 'Montoya Gómez',
            'birth_date' => '1990-02-22',
            'gender'     => 'm',
            'email'      => 'luismec90@gmail.com',
            'avatar'     => '1.jpg',
            'password'   => Hash::make('123'),
            'confirmed'  => 1
        ]);

        User::create([
            'id'         => 2,
            'first_name' => 'Mary',
            'last_name'  => 'Serna',
            'birth_date' => '1990-02-22',
            'gender'     => 'f',
            'email'      => 'mary.serna.8903@gmail.com',
            'avatar'     => 'default.png',
            'password'   => Hash::make('123'),
            'confirmed'  => 1
        ]);

        User::create([
            'id'         => 3,
            'first_name' => 'Andres Felipe',
            'last_name'  => 'Pineda Corcho',
            'birth_date' => '1990-02-22',
            'gender'     => 'm',
            'email'      => 'estudiante1@gmail.com',
            'avatar'     => 'default.png',
            'password'   => Hash::make('123'),
            'confirmed'  => 1
        ]);


        User::create([
            'id'         => 4,
            'first_name' => 'Juan',
            'last_name'  => 'Montoya',
            'birth_date' => '1990-02-22',
            'gender'     => 'm',
            'email'      => 'lfmontoyag@unal.edu.co',
            'avatar'     => 'default.png',
            'password'   => Hash::make('123'),
            'confirmed'  => 1
        ]);


        foreach (range(1, 80) as $index)
        {
            User::create([
                'dni'        => rand(11111111,999999999),
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'birth_date' => $faker->dateTime(),
                'gender'     => 'm',
                'email'      => $faker->email,
                'avatar'     => ($index + 4) < 15 ? ($index + 4) . '.jpg' : 'default.png',
                'password'   => Hash::make('1234'),
                'confirmed'  => 1
            ]);
        }

        User::create([
            'id'         => 85,
            'first_name' => 'Oscar Alejandro',
            'last_name'  => 'Montoya Gómez',
            'birth_date' => '1992-01-19',
            'gender'     => 'm',
            'email'      => 'alex@gmail.com',
            'avatar'     => 'default.png',
            'password'   => Hash::make('1234'),
            'confirmed'  => 1
        ]);


        User::create([
            'id'         => 86,
            'first_name' => 'Juan',
            'last_name'  => 'Váldez',
            'birth_date' => '1990-02-22',
            'gender'     => 'm',
            'email'      => 'monitor1@gmail.com',
            'avatar'     => 'default.png',
            'password'   => Hash::make('123'),
            'confirmed'  => 1
        ]);

        User::create([
            'id'         => 87,
            'first_name' => 'Julian',
            'last_name'  => 'Moreno',
            'birth_date' => '1990-02-22',
            'gender'     => 'm',
            'email'      => 'profesor1@gmail.com',
            'avatar'     => 'default.png',
            'password'   => Hash::make('123'),
            'confirmed'  => 1
        ]);
    }

}