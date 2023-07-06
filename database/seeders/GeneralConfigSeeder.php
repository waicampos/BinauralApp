<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Weekdays devem ficar com nome em inglês para funcionar corretamente com as funções de date_format
     */
    public function run(): void
    {

        DB::table('apps')->delete();
        DB::table('status')->delete();
        DB::table('weekdays')->delete();
        DB::table('file_types')->delete();
        DB::table('media_types')->delete();
        DB::table('configs')->delete();

        DB::table('apps')->insert([
            ['id' => 1, 'name' => 'Bi-Me', 'version' => '0.1'],
        ]);

        DB::table('configs')->insert([
            ['name' => 'app_name', 'value' => 'Bi-Me'],
            ['name' => 'app_version', 'value' => '0.1'],
            ['name' => 'cadastro_ativo_grupo_id', 'value' => 1],
        ]);

        DB::table('status')->insert([
            ['id' => 1, 'name' => 'ativo'],
            ['id' => 2, 'name' => 'inativo'],
            ['id' => 3, 'name' => 'deletado'],
            ['id' => 4, 'name' => 'cancelado'],
            ['id' => 5, 'name' => 'encerrado']
        ]);
  

        DB::table('weekdays')->insert([
            //['id' => 1, 'name' => "sunday", 'portuguese' => 'domingo'],
            ['id' => 1, 'name' => "monday", 'portuguese' => 'segunda-feira'],
            ['id' => 2, 'name' => "tuesday", 'portuguese' => 'terça-feira'],
            ['id' => 3, 'name' => "wednesday", 'portuguese' => 'quarta-feira'],
            ['id' => 4, 'name' => "thursday", 'portuguese' => 'quinta-feira'],
            ['id' => 5, 'name' => "friday", 'portuguese' => 'sexta-feira'],
            //['id' => 7, 'name' => "saturday", 'portuguese' => 'sábado']
        ]);
  
         
        DB::table('file_types')->insert([
            ['id' => 1, 'name' => 'edital'],
            ['id' => 2, 'name' => 'relatório'],
            ['id' => 3, 'name' => 'modelo_tlce'],
            ['id' => 4, 'name' => 'artigo']
        ]);


        DB::table('media_types')->insert([
            ['id' => 1, 'name' => 'binaural'],
            ['id' => 2, 'name' => 'video'],
            ['id' => 3, 'name' => 'music'],
            ['id' => 4, 'name' => 'image']
        ]);

        
  
    }
}
