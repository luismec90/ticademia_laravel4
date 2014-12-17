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

    }

    private function enrollingStudents()
    {
        DB::table('course_user')->insert(['user_id' => 1, 'course_id' => 1, 'level_id' => 1, 'role' => 1, 'group' => 5]);
        DB::table('course_user')->insert(['user_id' => 2, 'course_id' => 1, 'level_id' => 1, 'role' => 2, 'contact_information' => 'Lorem..']);

    }
}
