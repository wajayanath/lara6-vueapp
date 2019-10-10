<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the students table
        DB::table('students')->truncate();
        // generate 100 dummy students data
        $students = [];
        $faker = Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            $students[] = [
                'teacher_id'    => rand(1, 2),
                'classroom_id'    => rand(1, 3),
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'gender'        => $faker->randomElement(['M', 'F']),
                'joined_year'   => $faker->randomElement([2017, 2018, 2019])
            ];
        }
        DB::table('students')->insert($students);
    }
}
