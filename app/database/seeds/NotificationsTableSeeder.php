<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NotificationsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Notification::create([
            'user_id' => 1,
            'url'     => route('topic_path',[1, 1]),
            'body'    => 'El usuario Juan Montoya ha respondido el tema'
        ]);

        Notification::create([
            'user_id' => 3,
            'url'     => route('topic_path',[1, 1]),
            'body'    => 'El usuario Juan Montoya ha respondido el tema'
        ]);
    }

}