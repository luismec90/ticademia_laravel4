<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicRepliesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 150) as $index)
        {
            TopicReply::create([
                'id'       => $index,
                'topic_id' => rand(1,5),
                'user_id'  => rand(1, 12),
                'reply'    => $faker->text()
            ]);
        }
    }
}