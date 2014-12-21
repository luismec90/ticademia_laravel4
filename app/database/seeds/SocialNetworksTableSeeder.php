<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SocialNetworksTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        SocialNetwork::create([
            'user_id' => 1,
            'email'   => 'luis@gmail.com',
            'name'    => 'facebook'
        ]);
    }

}