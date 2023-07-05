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

        DB::table('status')->insert([
            ['id' => 1, 'name' => 'ativo'],
            ['id' => 2, 'name' => 'inativo'],
            ['id' => 3, 'name' => 'deletado'],
            ['id' => 4, 'name' => 'cancelado'],
            ['id' => 5, 'name' => 'encerrado']
        ]);
  

        DB::table('weekdays')->insert([
            ['id' => 1, 'name' => "sunday"],
            ['id' => 2, 'name' => "monday"],
            ['id' => 3, 'name' => "tuesday"],
            ['id' => 4, 'name' => "wednesday"],
            ['id' => 5, 'name' => "thursday"],
            ['id' => 6, 'name' => "friday"],
            ['id' => 7, 'name' => "saturday"]
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
    
  
        // DB::table('reasons')->insert(
        //     [
            
        // ]);
    
  
    }
}
