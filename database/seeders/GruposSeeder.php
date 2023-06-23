<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grupos')->insert([
          [
            'projeto_id' => 1,
            'nome' => 'Apenas Binaural',
            'numero' => 1,
            'descricao' => 'Grupo apenas binaural',
            'max_participantes' => 12,
            'oficina_dia' => 5,
            'oficina_horario' => '10:00:00',
            'status_id' => 1
          ],  
          [
            'projeto_id' => 1,
            'nome' => 'Binaural & Música',
            'numero' => 2,
            'descricao' => 'Grupo binaural e música',
            'max_participantes' => 12,
            'oficina_dia' => 5,
            'oficina_horario' => '10:30:00',
            'status_id' => 1
          ], 
          [
            'projeto_id' => 1,
            'nome' => 'Apenas Música',
            'numero' => 3,
            'descricao' => 'Grupo apenas música',
            'max_participantes' => 12,
            'oficina_dia' => 5,
            'oficina_horario' => '11:00:00',
            'status_id' => 1
          ], 
          [
            'projeto_id' => 1,
            'nome' => 'Controle',
            'numero' => 4,
            'descricao' => 'Grupo controle',
            'max_participantes' => 12,
            'oficina_dia' => 5,
            'oficina_horario' => '11:30:00',
            'status_id' => 1
          ]
        ]);
    }
    
}
