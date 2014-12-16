<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Course::create([
            'id'                   => 1,
            'subject_id'           => 1,
            'start_date'           => '2014-02-01',
            'end_date'             => '2014-06-01',
            'levels'               => '8',
            'type_of_registration' => 1,
            'threshold'            => 0.6
        ]);
    }

}