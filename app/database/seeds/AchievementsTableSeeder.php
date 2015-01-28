<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AchievementsTableSeeder extends Seeder {

    public function run()
    {

        $reward=20;

        Achievement::create([
            'id'          => 1,
            'name'        => 'Primer ejercicio',
            'description' => 'Se gana cuando se soluciona el primer ejercicio.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 6,
            'name'        => 'Mi primera participación en foro',
            'description' => 'Se gana cuando se participa por primera vez en el foro.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 7,
            'name'        => 'Tema popular',
            'description' => 'Se gana cuando un tema que creaste tiene mas de 5 entradas.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 8,
            'name'        => 'Tema Superpopular',
            'description' => 'Se gana cuando un tema que creaste tiene mas de 20 entradas.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 9,
            'name'        => 'Muy participativo',
            'description' => 'Se gana cuando un usuario escribe 5 entradas en el foro.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 10,
            'name'        => 'Superparticipativo',
            'description' => 'Se gana cuando un usuario escribe 20 entradas en el foro.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 11,
            'name'        => '3 en línea',
            'description' => 'Se gana cuando se resuelven 3 evaluaciones diferentes consecutivamente.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 12,
            'name'        => '5 en línea',
            'description' => 'Se gana cuando se resuelven 5 evaluaciones diferentes consecutivamente.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 13,
            'name'        => '10 en línea',
            'description' => 'Se gana cuando se resuelven 10 evaluaciones diferentes consecutivamente.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 14,
            'name'        => 'Mejor tiempo',
            'description' => 'Se gana cuando se obtiene el mejor tiempo en una evaluación.',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 15,
            'name'        => '25% del curso',
            'description' => '25% del curso',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 16,
            'name'        => '40% del curso',
            'description' => '40% del curso',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 17,
            'name'        => '60% del curso',
            'description' => '60% del curso',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 18,
            'name'        => '75% del curso',
            'description' => '75% del curso',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 19,
            'name'        => '100% del curso',
            'description' => '100% del curso',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 20,
            'name'        => 'Rompe-records',
            'description' => 'Mejor tiempo en 5 ejercicios',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 21,
            'name'        => 'Flash',
            'description' => 'Mejor tiempo en 15 ejercicios',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 22,
            'name'        => 'Primer material visto',
            'description' => 'Primer material visto',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 23,
            'name'        => 'Visualizador',
            'description' => '5 materiales vistos',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 24,
            'name'        => 'Súper visualizador',
            'description' => '10 materiales vistos',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 25,
            'name'        => 'Mega visualizador',
            'description' => 'Todos los materiales vistos',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 26,
            'name'        => 'Video-usuario',
            'description' => '3 videos vistos con porcentaje de reproducción superior al  75%',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 27,
            'name'        => 'Súper video-usuario',
            'description' => '12 videos vistos con porcentaje de reproducción superior al  75%',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 28,
            'name'        => 'Primera valoración',
            'description' => 'Primera valoración',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 29,
            'name'        => 'Valorador',
            'description' => '4 materiales valorados',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 30,
            'name'        => 'Súper valorador',
            'description' => '8 materiales valorados',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 31,
            'name'        => 'Mega-valorador',
            'description' => 'Todos los materiales valorados',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 32,
            'name'        => 'Colaborador',
            'description' => '4 me gusta en sus comentarios en foros',
            'reward'=>$reward
        ]);


        Achievement::create([
            'id'          => 33,
            'name'        => 'Altruista',
            'description' => '12 me gusta en sus comentarios en foros',
            'reward'=>$reward
        ]);


        Achievement::create([
            'id'          => 34,
            'name'        => 'Primera publicación en el muro',
            'description' => 'Primera publicación en el muro',
            'reward'=>$reward
        ]);


        Achievement::create([
            'id'          => 35,
            'name'        => 'Participativo',
            'description' => '7 publicaciones en el muro',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 36,
            'name'        => 'Muy popular',
            'description' => '5 me gusta en sus comentarios del muro',
            'reward'=>$reward
        ]);

        Achievement::create([
            'id'          => 37,
            'name'        => 'Súper popular',
            'description' => '10 me gusta en sus comentarios del muro',
            'reward'=>$reward
        ]);
        Achievement::create([
            'id'          => 38,
            'name'        => '3 horas conectado',
            'description' => '3 horas conectado',
            'reward'=>$reward
        ]);
        Achievement::create([
            'id'          => 39,
            'name'        => '6 horas conectado',
            'description' => '6 horas conectado',
            'reward'=>$reward
        ]);
        Achievement::create([
            'id'          => 40,
            'name'        => '12 horas conectado',
            'description' => '12 horas conectado',
            'reward'=>$reward
        ]);
        Achievement::create([
            'id'          => 41,
            'name'        => '24 horas conectado',
            'description' => '24 horas conectado',
            'reward'=>$reward
        ]);
        Achievement::create([
            'id'          => 42,
            'name'        => '36 horas conectado',
            'description' => '36 horas conectado',
            'reward'=>$reward
        ]);
        Achievement::create([
            'id'          => 43,
            'name'        => '72 horas conectado',
            'description' => '72 horas conectado',
            'reward'=>$reward
        ]);

    }
}