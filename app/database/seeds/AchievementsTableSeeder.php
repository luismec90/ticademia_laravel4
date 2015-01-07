<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AchievementsTableSeeder extends Seeder {

    public function run()
    {


        Achievement::create([
            'id'          => 1,
            'name'        => 'Primer ejercicio',
            'description' => 'Se gana cuando se soluciona el primer ejercicio.'
        ]);

        Achievement::create([
            'id'          => 6,
            'name'        => 'Mi primera participación en foro',
            'description' => 'Se gana cuando se participa por primera vez en el foro.'
        ]);

        Achievement::create([
            'id'          => 7,
            'name'        => 'Tema popular',
            'description' => 'Se gana cuando un tema que creaste tiene mas de 5 entradas.'
        ]);

        Achievement::create([
            'id'          => 8,
            'name'        => 'Tema Superpopular',
            'description' => 'Se gana cuando un tema que creaste tiene mas de 20 entradas.'
        ]);

        Achievement::create([
            'id'          => 9,
            'name'        => 'Muy participativo',
            'description' => 'Se gana cuando un usuario escribe 5 entradas en el foro.'
        ]);

        Achievement::create([
            'id'          => 10,
            'name'        => 'Superparticipativo',
            'description' => 'Se gana cuando un usuario escribe 20 entradas en el foro.'
        ]);

        Achievement::create([
            'id'          => 11,
            'name'        => '3 en línea',
            'description' => 'Se gana cuando se resuelven 3 evaluaciones diferentes consecutivamente.'
        ]);

        Achievement::create([
            'id'          => 12,
            'name'        => '5 en línea',
            'description' => 'Se gana cuando se resuelven 5 evaluaciones diferentes consecutivamente.'
        ]);

        Achievement::create([
            'id'          => 13,
            'name'        => '10 en línea',
            'description' => 'Se gana cuando se resuelven 10 evaluaciones diferentes consecutivamente.'
        ]);

        Achievement::create([
            'id'          => 14,
            'name'        => 'Mejor tiempo',
            'description' => 'Se gana cuando se obtiene el mejor tiempo en una evaluación.'
        ]);

    }

}