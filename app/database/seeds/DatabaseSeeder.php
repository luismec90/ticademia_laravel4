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
        //$this->call('WallMessagesTableSeeder');
        $this->call('TopicsTableSeeder');
        //$this->call('TopicRepliesTableSeeder');
        $this->call('SocialNetworksTableSeeder');
        $this->call('ModulesTableSeeder');
        $this->call('MaterialsTableSeeder');
        $this->call('QuizTypesTableSeeder');
        $this->call('QuizzesTableSeeder');
        $this->call('NotificationsTableSeeder');
        //$this->call('ModuleUserTableSeeder');
        $this->call('AchievementsTableSeeder');
        // $this->call('ReachedAchievementsTableSeeder');
        //$this->call('ReviewsTableSeeder');

        $this->relateMaterialQuiz();
    }

    private function enrollingStudents()
    {
        DB::table('course_user')->insert(['user_id' => 1, 'course_id' => 1, 'level_id' => 1, 'role' => 1]);
        DB::table('course_user')->insert(['user_id' => 2, 'course_id' => 1, 'level_id' => 1, 'role' => 1]);
        DB::table('course_user')->insert(['user_id' => 3, 'course_id' => 1, 'level_id' => 1, 'role' => 2]);
        DB::table('course_user')->insert(['user_id' => 4, 'course_id' => 1, 'level_id' => 1, 'role' => 3]);
    }

    private function relateMaterialQuiz()
    {
        /*Sección 1 */

        DB::table('material_quiz')->insert(['quiz_id' => 1, 'material_id' => 3]);
        DB::table('material_quiz')->insert(['quiz_id' => 4, 'material_id' => 3]);
        DB::table('material_quiz')->insert(['quiz_id' => 5, 'material_id' => 2]);
        DB::table('material_quiz')->insert(['quiz_id' => 5, 'material_id' => 3]);
        DB::table('material_quiz')->insert(['quiz_id' => 6, 'material_id' => 2]);
        DB::table('material_quiz')->insert(['quiz_id' => 6, 'material_id' => 3]);
        DB::table('material_quiz')->insert(['quiz_id' => 7, 'material_id' => 2]);
        DB::table('material_quiz')->insert(['quiz_id' => 8, 'material_id' => 2]);
        DB::table('material_quiz')->insert(['quiz_id' => 9, 'material_id' => 3]);
        DB::table('material_quiz')->insert(['quiz_id' => 10, 'material_id' => 3]);
        DB::table('material_quiz')->insert(['quiz_id' => 11, 'material_id' => 4]);
        DB::table('material_quiz')->insert(['quiz_id' => 12, 'material_id' => 5]);
        DB::table('material_quiz')->insert(['quiz_id' => 13, 'material_id' => 5]);
        DB::table('material_quiz')->insert(['quiz_id' => 14, 'material_id' => 5]);
        DB::table('material_quiz')->insert(['quiz_id' => 15, 'material_id' => 7]);
        DB::table('material_quiz')->insert(['quiz_id' => 16, 'material_id' => 7]);
        DB::table('material_quiz')->insert(['quiz_id' => 17, 'material_id' => 7]);
        DB::table('material_quiz')->insert(['quiz_id' => 18, 'material_id' => 8]);
        DB::table('material_quiz')->insert(['quiz_id' => 19, 'material_id' => 7]);
        DB::table('material_quiz')->insert(['quiz_id' => 20, 'material_id' => 5]);
        DB::table('material_quiz')->insert(['quiz_id' => 20, 'material_id' => 8]);

        DB::table('material_quiz')->insert(['quiz_id' => 21, 'material_id' => 7]);
        DB::table('material_quiz')->insert(['quiz_id' => 21, 'material_id' => 13]);

        DB::table('material_quiz')->insert(['quiz_id' => 22, 'material_id' => 9]);
        DB::table('material_quiz')->insert(['quiz_id' => 22, 'material_id' => 10]);
        DB::table('material_quiz')->insert(['quiz_id' => 22, 'material_id' => 11]);

        DB::table('material_quiz')->insert(['quiz_id' => 23, 'material_id' => 9]);
        DB::table('material_quiz')->insert(['quiz_id' => 23, 'material_id' => 10]);
        DB::table('material_quiz')->insert(['quiz_id' => 23, 'material_id' => 11]);

        DB::table('material_quiz')->insert(['quiz_id' => 24, 'material_id' => 9]);
        DB::table('material_quiz')->insert(['quiz_id' => 24, 'material_id' => 10]);
        DB::table('material_quiz')->insert(['quiz_id' => 24, 'material_id' => 11]);

        DB::table('material_quiz')->insert(['quiz_id' => 25, 'material_id' => 9]);
        DB::table('material_quiz')->insert(['quiz_id' => 25, 'material_id' => 10]);
        DB::table('material_quiz')->insert(['quiz_id' => 25, 'material_id' => 11]);

        DB::table('material_quiz')->insert(['quiz_id' => 26, 'material_id' => 9]);
        DB::table('material_quiz')->insert(['quiz_id' => 26, 'material_id' => 10]);
        DB::table('material_quiz')->insert(['quiz_id' => 26, 'material_id' => 11]);

        DB::table('material_quiz')->insert(['quiz_id' => 27, 'material_id' => 12]);
        DB::table('material_quiz')->insert(['quiz_id' => 28, 'material_id' => 13]);
        DB::table('material_quiz')->insert(['quiz_id' => 29, 'material_id' => 13]);
        DB::table('material_quiz')->insert(['quiz_id' => 29, 'material_id' => 13]);
        DB::table('material_quiz')->insert(['quiz_id' => 30, 'material_id' => 14]);
        DB::table('material_quiz')->insert(['quiz_id' => 31, 'material_id' => 14]);


    }


}
