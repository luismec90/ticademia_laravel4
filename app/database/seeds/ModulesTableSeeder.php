<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ModulesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $starDate = "2015-02-02 00:00:00";

        for ($i = 1; $i <= 16; $i ++)
        {
            $fecha = new DateTime($starDate);
            $fecha->add(new DateInterval('P6DT23H59M59S'));
            $endDate = $fecha->format('Y-m-d H:i:s');

            Module::create([
                'id'          => $i,
                'course_id'   => 1,
                'name'        => "Módulo $i",
                'description' => $faker->text(),
                'start_date'  => $starDate,
                'end_date'    => $endDate
            ]);

            $fecha->add(new DateInterval('PT1S'));
            $starDate = $fecha->format('Y-m-d H:i:s');
        }

    }

}