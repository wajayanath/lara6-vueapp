<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the teachers table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('teachers')->truncate();
        //generate 2 teachers
        DB::table('teachers')->insert([
            [
                'name' => "Emily",
            ],
            [
                'name' => "Isabella",
            ]
        ]);
    }
}
