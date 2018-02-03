<?php

declare(strict_types=1);
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('students')->insert([
            'id' => 0,
            'student_id' => '103340703',
            'display_name' => 'Leandro Siow',
            'recognized' => false,
        ]);
    }
}
