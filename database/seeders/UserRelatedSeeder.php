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

        DB::table('civil_states')->delete();
        DB::table('categories')->delete();
        DB::table('withdraw_reasons')->delete();
        DB::table('roles')->delete();

            
        DB::table('civil_states')->insert([
            ['id' => 1, 'name' => 'solteiro/a'],
            ['id' => 2, 'name' => 'casado/a'],
            ['id' => 3, 'name' => 'união estável'],
            ['id' => 4, 'name' => 'divorciado/a'],
            ['id' => 5, 'name' => 'viúvo/a']
        ]);
    
  
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'coordenador'],
            ['id' => 2, 'name' => 'professor'],
            ['id' => 3, 'name' => 'técnico'],
            ['id' => 4, 'name' => 'bolsista'],
            ['id' => 5, 'name' => 'estagiário'],
            ['id' => 6, 'name' => 'voluntário']
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
            ['id' => 2, 'name' => 'member'],
            ['id' => 3, 'name' => 'team'],
            ['id' => 4, 'name' => 'admin']
        ]);

        
    }

}
