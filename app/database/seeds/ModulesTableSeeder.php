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
            'end_date'    => '2015-02-11 23:59:59'
        ]);

        $starDate = "2015-02-12 00:00:00";

        for ($i = 2; $i <= 15; $i ++)
        {
            $fecha = new DateTime($starDate);
            $fecha->add(new DateInterval('P6DT23H59M59S'));
            $endDate = $fecha->format('Y-m-d H:i:s');

            Module::create([
                'id'          => $i,
                'course_id'   => 1,
                'name'        => "Módulo $i",
                'description' => '',
                'start_date'  => $starDate,
                'end_date'    => $endDate
            ]);

            $fecha->add(new DateInterval('PT1S'));
            $starDate = $fecha->format('Y-m-d H:i:s');
        }

    }

}