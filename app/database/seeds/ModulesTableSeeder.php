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
            'name'        => "Módulo 1",
            'description' => '',
            'start_date'  => '2015-02-02 00:00:00',
            'end_date'    => '2015-02-25 23:59:59'
        ]);

        Module::create([
            'id'          => 2,
            'course_id'   => 1,
            'name'        => "Módulo 2",
            'description' => '',
            'start_date'  => '2015-02-02 00:00:00',
            'end_date'    => '2015-02-25 23:59:59'
        ]);

        Module::create([
            'id'          => 3,
            'course_id'   => 1,
            'name'        => "Módulo 3",
            'description' => '',
            'start_date'  => '2015-02-02 00:00:00',
            'end_date'    => '2015-02-25 23:59:59'
        ]);

        Module::create([
            'id'          => 4,
            'course_id'   => 1,
            'name'        => "Módulo 4",
            'description' => '',
            'start_date'  => '2015-02-26 00:00:00',
            'end_date'    => '2015-03-04 23:59:59'
        ]);

        Module::create([
            'id'          => 5,
            'course_id'   => 1,
            'name'        => "Módulo 5",
            'description' => '',
            'start_date'  => '2015-03-05 00:00:00',
            'end_date'    => '2015-03-11 23:59:59'
        ]);

        Module::create([
            'id'          => 6,
            'course_id'   => 1,
            'name'        => "Módulo 6",
            'description' => '',
            'start_date'  => '2015-03-12 00:00:00',
            'end_date'    => '2015-03-18 23:59:59'
        ]);

        Module::create([
            'id'          => 7,
            'course_id'   => 1,
            'name'        => "Módulo 7",
            'description' => '',
            'start_date'  => '2015-03-19 00:00:00',
            'end_date'    => '2015-03-25 23:59:59'
        ]);

        Module::create([
            'id'          => 8,
            'course_id'   => 1,
            'name'        => "Módulo 8",
            'description' => '',
            'start_date'  => '2015-03-26 00:00:00',
            'end_date'    => '2015-04-08 23:59:59'
        ]);

        Module::create([
            'id'          => 9,
            'course_id'   => 1,
            'name'        => "Módulo 9",
            'description' => '',
            'start_date'  => '2015-04-09 00:00:00',
            'end_date'    => '2015-04-15 23:59:59'
        ]);

        Module::create([
            'id'          => 10,
            'course_id'   => 1,
            'name'        => "Módulo 10",
            'description' => '',
            'start_date'  => '2015-04-16 00:00:00',
            'end_date'    => '2015-04-22 23:59:59'
        ]);

        Module::create([
            'id'          => 11,
            'course_id'   => 1,
            'name'        => "Módulo 11",
            'description' => '',
            'start_date'  => '2015-04-23 00:00:00',
            'end_date'    => '2015-04-29 23:59:59'
        ]);

        Module::create([
            'id'          => 12,
            'course_id'   => 1,
            'name'        => "Módulo 12",
            'description' => '',
            'start_date'  => '2015-04-30 00:00:00',
            'end_date'    => '2015-05-06 23:59:59'
        ]);

        Module::create([
            'id'          => 13,
            'course_id'   => 1,
            'name'        => "Módulo 13",
            'description' => '',
            'start_date'  => '2015-04-07 00:00:00',
            'end_date'    => '2015-05-13 23:59:59'
        ]);

        Module::create([
            'id'          => 14,
            'course_id'   => 1,
            'name'        => "Módulo 14",
            'description' => '',
            'start_date'  => '2015-05-14 00:00:00',
            'end_date'    => '2015-05-20 23:59:59'
        ]);

        Module::create([
            'id'          => 15,
            'course_id'   => 1,
            'name'        => "Módulo 15",
            'description' => '',
            'start_date'  => '2015-05-21 00:00:00',
            'end_date'    => '2015-05-27 23:59:59'
        ]);

    }

}