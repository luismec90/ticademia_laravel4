<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ModulesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Module::create([
            'id'          => 1,
            'course_id'   => 1,
            'name'        => 'Geometría elemental, conjuntos y sistemas numéricos',
            'description' => $faker->text(),
            'start_date'  => '2014-08-11',
            'end_date'    => '2015-08-11'
        ]);

        Module::create([
            'id'          => 2,
            'course_id'   => 1,
            'name'        => 'Álgebra',
            'description' => $faker->text(),
            'start_date'  => '2014-09-05',
            'end_date'    => '2014-10-13'
        ]);

        Module::create([
            'id'          => 3,
            'course_id'   => 1,
            'name'        => 'Ecuaciones y desigualdades',
            'description' => $faker->text(),
            'start_date'  => '2014-10-06',
            'end_date'    => '2014-11-26'
        ]);

        Module::create([
            'id'          => 4,
            'course_id'   => 1,
            'name'        => 'Funciones reales',
            'description' => $faker->text(),
            'start_date'  => '2014-10-22',
            'end_date'    => '2014-11-26'
        ]);

        Module::create([
            'id'          => 5,
            'course_id'   => 1,
            'name'        => 'Trigonometría',
            'description' => $faker->text(),
            'start_date'  => '2014-11-12',
            'end_date'    => '2014-12-03'
        ]);
    }

}