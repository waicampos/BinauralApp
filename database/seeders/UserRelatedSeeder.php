<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRelatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 

        DB::table('categories')->delete();
        DB::table('withdraw_reasons')->delete();
        DB::table('roles')->delete();
    
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'coordenador/a'],
            ['id' => 2, 'name' => 'professor/a'],
            ['id' => 3, 'name' => 'técnico/a'],
            ['id' => 4, 'name' => 'bolsista'],
            ['id' => 5, 'name' => 'estagiário/a'],
            ['id' => 6, 'name' => 'voluntário/a']
        ]);
  
        DB::table('withdraw_reasons')->insert([
            ['id' => 1, 'name' => 'falta de tempo'],
            ['id' => 2, 'name' => 'falta de interesse'],
            ['id' => 3, 'name' => 'mudança de cidade ou escola'],
            ['id' => 4, 'name' => 'desconforto com a metodologia das oficinas'],
            ['id' => 5, 'name' => 'incompatibilidade com o projeto'],
            ['id' => 6, 'name' => 'outro'],
        ]);

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'group_member'],
            ['id' => 3, 'name' => 'team'],
            ['id' => 4, 'name' => 'admin']
        ]);
        
    }

}
