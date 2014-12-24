<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NotificationsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Notification::create([
            'user_id' => 1,
            'url'     => route('topic_path',[1, 1]) . "?page=2",
            'body'    => 'El usuario Luis montoya ha respondido el tema'
        ]);
    }

}