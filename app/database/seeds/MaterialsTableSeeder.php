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
            'description' => '',
            'duration'    => '509',
            'url'         => 'yp6btB0-mLQ',
            'type'        => 'video',
            'order'       => '1'
        ]);


        Material::create([
            'id'          => 2,
            'module_id'   => 1,
            'name'        => 'Definición y clasificación de ángulos II',
            'description' => '',
            'duration'    => '761',
            'url'         => 'o5a78Er53wg',
            'type'        => 'video',
            'order'       => '2'
        ]);

        Material::create([
            'id'          => 3,
            'module_id'   => 1,
            'name'        => 'Teorema fundamentales de los triángulos',
            'description' => '',
            'duration'    => '1014',
            'url'         => 'FAQQjwGWkqk',
            'type'        => 'video',
            'order'       => '3'
        ]);

        Material::create([
            'id'          => 4,
            'module_id'   => 1,
            'name'        => 'Criterios de congruencia entre triángulos ',
            'description' => '',
            'duration'    => '914',
            'url'         => 'HHbZXBNk-Qo',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 5,
            'module_id'   => 1,
            'name'        => 'Aplicaciones de los criterios de congruencia entre triángulos',
            'description' => '',
            'duration'    => '1479',
            'url'         => 'Li4lOVJ7kUU',
            'type'        => 'video',
            'order'       => '5'
        ]);


        Material::create([
            'id'          => 6,
            'module_id'   => 1,
            'name'        => 'Criterios de semejanza entre triángulos',
            'description' => '',
            'duration'    => '913',
            'url'         => 'cddq4TbrH9E',
            'type'        => 'video',
            'order'       => '6'
        ]);


        Material::create([
            'id'          => 7,
            'module_id'   => 1,
            'name'        => 'Aplicaciones de los criterios de semejanza entre triángulos',
            'description' => '',
            'duration'    => '1374',
            'url'         => 'XRwNRWBBdxE',
            'type'        => 'video',
            'order'       => '7'
        ]);


        Material::create([
            'id'          => 8,
            'module_id'   => 1,
            'name'        => 'Teorema de Pitágoras',
            'description' => '',
            'duration'    => '1502',
            'url'         => 'TGGK-sKL47Q',
            'type'        => 'video',
            'order'       => '8'
        ]);


        Material::create([
            'id'          => 9,
            'module_id'   => 2,
            'name'        => 'Áreas de figuras planas I',
            'description' => '',
            'duration'    => '976',
            'url'         => 'ECNaCQm5pME',
            'type'        => 'video',
            'order'       => '1'
        ]);


        Material::create([
            'id'          => 10,
            'module_id'   => 2,
            'name'        => 'Áreas de figuras planas II',
            'description' => '',
            'duration'    => '1298',
            'url'         => 'fyMVXWk-o98',
            'type'        => 'video',
            'order'       => '2'
        ]);

        Material::create([
            'id'          => 11,
            'module_id'   => 2,
            'name'        => 'Áreas de figuras planas III',
            'description' => '',
            'duration'    => '954',
            'url'         => 'rUDn-6JnGXI',
            'type'        => 'video',
            'order'       => '3'
        ]);

        Material::create([
            'id'          => 12,
            'module_id'   => 2,
            'name'        => 'Elementos de la circunferencia',
            'description' => '',
            'duration'    => '651',
            'url'         => 'mk8OAMgpXfI',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 13,
            'module_id'   => 2,
            'name'        => 'Volúmenes de solidos geométricos',
            'description' => '',
            'duration'    => '1568',
            'url'         => '22hAVvfzUdU',
            'type'        => 'video',
            'order'       => '5'
        ]);

        Material::create([
            'id'          => 14,
            'module_id'   => 2,
            'name'        => 'Áreas de solidos geométricos',
            'description' => '',
            'duration'    => '924',
            'url'         => 'HcLsiouFyCQ',
            'type'        => 'video',
            'order'       => '6'
        ]);


        Material::create([
            'id'          => 15,
            'module_id'   => 3,
            'name'        => 'Algebra de conjuntos',
            'description' => '',
            'duration'    => '1783',
            'url'         => 'K9B2kaF0WSw',
            'type'        => 'video',
            'order'       => '1'
        ]);


        Material::create([
            'id'          => 16,
            'module_id'   => 3,
            'name'        => 'Aplicación del algebra de conjuntos',
            'description' => '',
            'duration'    => '1387',
            'url'         => 'fs5RZ5AR_YQ',
            'type'        => 'video',
            'order'       => '2'
        ]);

        Material::create([
            'id'          => 17,
            'module_id'   => 3,
            'name'        => 'Conjuntos numéricos',
            'description' => '',
            'duration'    => '1416',
            'url'         => '81xiA3p8UZc',
            'type'        => 'video',
            'order'       => '3'
        ]);



        Material::create([
            'id'          => 18,
            'module_id'   => 3,
            'name'        => 'Operaciones y propiedades de números reales y fraccionarios',
            'description' => '',
            'duration'    => '1559',
            'url'         => 'QLvZyQ8MURU',
            'type'        => 'video',
            'order'       => '4'
        ]);

        Material::create([
            'id'          => 19,
            'module_id'   => 3,
            'name'        => 'Orden en los reales, intervalos *',
            'description' => '',
            'duration'    => '320',
            'url'         => '',
            'type'        => 'video',
            'order'       => '5'
        ]);
        Material::create([
            'id'          => 20,
            'module_id'   => 3,
            'name'        => 'Distancia y valor absoluto *',
            'description' => '',
            'duration'    => '320',
            'url'         => '',
            'type'        => 'video',
            'order'       => '6'
        ]);

    }

}