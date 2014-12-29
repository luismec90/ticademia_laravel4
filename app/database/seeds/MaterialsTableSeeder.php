<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MaterialsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Material::create([
            'id'          => 1,
            'module_id'   => 1,
            'name'        => 'Definición y clasificación de ángulos I',
            'description' => $faker->text(5),
            'url'         => 'eW3gMGqcZQc',
            'type'        => 'video',
            'order'       => '1'
        ]);

        Material::create([
            'id'          => 2,
            'module_id'   => 1,
            'name'        => 'Definición y clasificación de ángulos II',
            'description' => $faker->text(5),
            'url'         => 'HPA1dNH-rlo',
            'type'        => 'video',
            'order'       => '2'
        ]);

        Material::create([
            'id'          => 3,
            'module_id'   => 1,
            'name'        => 'Teorema fundamentales de los triángulos',
            'description' => $faker->text(5),
            'url'         => 'MCbKYBUeE3U',
            'type'        => 'video',
            'order'       => '3'
        ]);

        Material::create([
            'id'          => 4,
            'module_id'   => 1,
            'name'        => 'Criterios de congruencia entre triángulos ',
            'description' => $faker->text(5),
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
    }

}