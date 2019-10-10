<?php

use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the classrooms table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('classrooms')->truncate();
        //generate 3 classrooms
        DB::table('classrooms')->insert([
            [
                'class' => "A"
            ],
            [
                'class' => "B"
            ],
            [
                'class' => "C"
            ],
        ]);
    }
}
