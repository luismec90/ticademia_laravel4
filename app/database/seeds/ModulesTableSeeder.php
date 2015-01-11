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
            'start_date'  => '2015-01-10',
            'end_date'    => '2015-01-20'
        ]);

        Module::create([
            'id'          => 2,
            'course_id'   => 1,
            'name'        => 'Álgebra',
            'description' => $faker->text(),
            'start_date'  => '2015-01-20',
            'end_date'    => '2015-01-30'
        ]);

        Module::create([
            'id'          => 3,
            'course_id'   => 1,
            'name'        => 'Ecuaciones y desigualdades',
            'description' => $faker->text(),
            'start_date'  => '2015-01-30',
            'end_date'    => '2015-02-09'
        ]);

        Module::create([
            'id'          => 4,
            'course_id'   => 1,
            'name'        => 'Funciones reales',
            'description' => $faker->text(),
            'start_date'  => '2015-02-09',
            'end_date'    => '2015-02-19'
        ]);

        Module::create([
            'id'          => 5,
            'course_id'   => 1,
            'name'        => 'Trigonometría',
            'description' => $faker->text(),
            'start_date'  => '2015-02-19',
            'end_date'    => '2015-03-1'
        ]);
    }

}