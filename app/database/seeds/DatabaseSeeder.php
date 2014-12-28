<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('SubjectsTableSeeder');
        $this->call('CoursesTableSeeder');
        $this->call('LevelsTableSeeder');
        $this->enrollingStudents();
        $this->call('WallMessagesTableSeeder');
        $this->call('TopicsTableSeeder');
        $this->call('TopicRepliesTableSeeder');
        $this->call('SocialNetworksTableSeeder');
        $this->call('ModulesTableSeeder');
        $this->call('MaterialsTableSeeder');
        $this->call('QuizzesTableSeeder');
        $this->call('NotificationsTableSeeder');
        $this->call('ModuleUserTableSeeder');
        $this->call('AchievementsTableSeeder');

    }

    private function enrollingStudents()
    {
        foreach (range(1, 80) as $index)
        {
            DB::table('course_user')->insert(['user_id' => $index, 'course_id' => 1, 'level_id' => 1, 'role' => 1, 'group' => rand(1,5)]);
        }

    }

}
