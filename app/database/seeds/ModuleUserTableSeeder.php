<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ModuleUserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 80) as $index)
        {
            ModuleUser::create([
                'module_id' => 1,
                'user_id'   => $index,
                'score'     => rand(1, 800)
            ]);
        }
    }

}