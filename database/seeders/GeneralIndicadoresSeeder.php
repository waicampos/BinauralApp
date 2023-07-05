<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralIndicadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('indicators')->delete();
        DB::table('apps')->delete();
        DB::table('options')->delete();
        DB::table('app_indicator')->delete();

        DB::table('apps')->insert([
            ['id' => 1, 'name' => 'Bi-Me', 'version' => '0.1'],
        ]);
            
        DB::table('indicators')->insert([
            ['id' => 1, 'name' => 'gênero'],
            ['id' => 2, 'name' => 'cor'],
            ['id' => 3, 'name' => 'estado civil']
        ]);

        DB::table('options')->insert([
            ['name' => 'feminino', 'indicator_id' => 1],
            ['name' => 'masculino', 'indicator_id' => 1],
            ['name' => 'outro', 'indicator_id' => 1],
            ['name' => 'branco/a', 'indicator_id' => 2],
            ['name' => 'negro/a', 'indicator_id' => 2],
            ['name' => 'pardo/a', 'indicator_id' => 2],
            ['name' => 'indígena', 'indicator_id' => 2],
            ['name' => 'outro', 'indicator_id' => 2],
            ['name' => 'solteiro/a', 'indicator_id' => 3],
            ['name' => 'casado/a', 'indicator_id' => 3],
            ['name' => 'união estável', 'indicator_id' => 3],
            ['name' => 'divorciado/a', 'indicator_id' => 3],
            ['name' => 'viúvo/a', 'indicator_id' => 3]            
        ]);

        DB::table('app_indicator')->insert([
            ['app_id' => 1, 'indicator_id' => 1],
            ['app_id' => 1, 'indicator_id' => 2],
            ['app_id' => 1, 'indicator_id' => 3]
        ]);

    }
}
