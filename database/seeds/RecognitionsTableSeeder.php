<?php

declare(strict_types=1);
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecognitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('recognitions')->insert([
            'professor_id' => 'members:103166750',
            'student_id' => '103340703',
        ]);
        DB::table('recognitions')->insert([
            'professor_id' => 'members:103166750',
            'student_id' => '104011529',
        ]);
    }
}
