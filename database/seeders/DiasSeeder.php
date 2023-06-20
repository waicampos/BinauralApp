<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dias')->insert([
            ['nome' => "sunday"],
            ['nome' => "monday"],
            ['nome' => "tuesday"],
            ['nome' => "wednesday"],
            ['nome' => "thursday"],
            ['nome' => "friday"],
            ['nome' => "saturday"]
        ]);
    }
}
