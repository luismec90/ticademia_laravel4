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
            'duration'    => '120',
            'url'         => 'eW3gMGqcZQc',
            'type'        => 'video',
            'order'       => '1'
        ]);

        Material::create([
            'id'          => 2,
            'module_id'   => 1,
            'name'        => 'Definición y clasificación de ángulos II',
            'description' => $faker->text(5),
            'duration'    => '150',
            'url'         => 'HPA1dNH-rlo',
            'type'        => 'video',
            'order'       => '2'
        ]);

        Material::create([
            'id'          => 3,
            'module_id'   => 1,
            'name'        => 'Teorema fundamentales de los triángulos',
            'description' => $faker->text(5),
            'duration'    => '220',
            'url'         => 'MCbKYBUeE3U',
            'type'        => 'video',
            'order'       => '3'
        ]);

        Material::create([
            'id'          => 4,
            'module_id'   => 1,
            'name'        => 'Criterios de congruencia entre triángulos ',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 5,
            'module_id'   => 1,
            'name'        => 'Aplicaciones de los criterios de congruencia entre triángulos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 6,
            'module_id'   => 1,
            'name'        => 'Criterios de semejanza entre triángulos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 7,
            'module_id'   => 1,
            'name'        => 'Aplicaciones de los criterios de semejanza entre triángulos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 8,
            'module_id'   => 1,
            'name'        => 'Teorema de Pitágoras',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 9,
            'module_id'   => 1,
            'name'        => 'Áreas de figuras planas I',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 10,
            'module_id'   => 1,
            'name'        => 'Áreas de figuras planas II',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 11,
            'module_id'   => 1,
            'name'        => 'Áreas de figuras planas III',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 12,
            'module_id'   => 1,
            'name'        => 'Elementos de la circunferencia',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 13,
            'module_id'   => 1,
            'name'        => 'Volúmenes de solidos geométricos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 14,
            'module_id'   => 1,
            'name'        => 'Áreas de solidos geométricos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 15,
            'module_id'   => 1,
            'name'        => 'Algebra de conjuntos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 16,
            'module_id'   => 1,
            'name'        => 'Aplicación del algebra de conjuntos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 17,
            'module_id'   => 1,
            'name'        => 'Conjuntos numéricos',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 18,
            'module_id'   => 1,
            'name'        => 'Algebra de conjuntos en la recta numérica',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);
        Material::create([
            'id'          => 19,
            'module_id'   => 1,
            'name'        => 'Operaciones y propiedades de números reales y fraccionarios',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 20,
            'module_id'   => 1,
            'name'        => 'Valor absoluto',
            'description' => $faker->text(5),
            'duration'    => '320',
            'url'         => 'x3k-O_jtxoU',
            'type'        => 'video',
            'order'       => '4'
        ]);

    }

}