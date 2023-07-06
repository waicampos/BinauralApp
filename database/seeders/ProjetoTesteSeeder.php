<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetoTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('projects')->delete();
        DB::table('groups')->delete();

        DB::table('projects')->insert([
            [
                'id' => 1,
                'name' => "Projeto Teste 2023.2",
                'description' => 'Projeto desenvolvido no segundo semestre de 2023',
                'contact' => 'NAE',
                'tlce_model' => '',
                'starts_at' => '2023-07-07',
                'ends_at' => '2023-08-01',
                'created_at' => Carbon::now('America/Sao_Paulo'),
                'updated_at' => Carbon::now('America/Sao_Paulo'),
                'status_id' => 1,
            ],
            [
                'id' => 2,
                'name' => "Projeto Oficinas Binaurais 2023.2",
                'description' => 'Projeto desenvolvido no segundo semestre de 2023',
                'contact' => 'NAE',
                'tlce_model' => '',
                'starts_at' => '2023-08-01',
                'ends_at' => '2023-10-31',
                'created_at' => Carbon::now('America/Sao_Paulo'),
                'updated_at' => Carbon::now('America/Sao_Paulo'),
                'status_id' => 2,
            ],
        ]);

        DB::table('groups')->insert([
            'id' => 1,
            'number' => 1,
            'name' => 'Grupo de Teste - Binaural & Música',
            'description' => '',
            'max_members' => 12,
            'hour' => '10:00:00',
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
            'needs_playlist' => 1,
            'needs_binaural' => 1,
            'needs_video' => 1,
            'project_id' => 1,
            'weekday_id' => 5,
            'status_id' => 1,
        ]);

        DB::table('groups')->insert([
            'id' => 2,
            'number' => 2,
            'name' => 'Grupo de Teste - SÓ Binaural',
            'description' => '',
            'max_members' => 12,
            'hour' => '10:30:00',
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
            'needs_playlist' => 0,
            'needs_binaural' => 1,
            'needs_video' => 1,
            'project_id' => 1,
            'weekday_id' => 5,
            'status_id' => 1,
        ]);

        DB::table('groups')->insert([
            'id' => 3,
            'number' => 3,
            'name' => 'Grupo de Teste - SÓ Música',
            'description' => '',
            'max_members' => 12,
            'hour' => '11:00:00',
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
            'needs_playlist' => 1,
            'needs_binaural' => 0,
            'needs_video' => 1,
            'project_id' => 1,
            'weekday_id' => 5,
            'status_id' => 1,
        ]);

        DB::table('groups')->insert([
            'id' => 4,
            'number' => 4,
            'name' => 'Grupo de Teste - SEM Binaural & SEM Música',
            'description' => '',
            'max_members' => 12,
            'hour' => '11:30:00',
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
            'needs_playlist' => 0,
            'needs_binaural' => 0,
            'needs_video' => 1,
            'project_id' => 1,
            'weekday_id' => 5,
            'status_id' => 1,
        ]);

        DB::table('groups')->insert([
            'id' => 5,
            'number' => 1,
            'name' => 'Grupo de Teste - Grupo Ativo em Projeto Inativo?',
            'description' => '',
            'max_members' => 12,
            'hour' => '08:00:00',
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
            'needs_playlist' => 1,
            'needs_binaural' => 1,
            'needs_video' => 1,
            'project_id' => 2,
            'weekday_id' => 5,
            'status_id' => 1,
        ]);

        DB::table('groups')->insert([
            'id' => 6,
            'number' => 5,
            'name' => 'Grupo de Teste - Grupo Inativo em Projeto Ativo',
            'description' => '',
            'max_members' => 12,
            'hour' => '08:30:00',
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo'),
            'needs_playlist' => 1,
            'needs_binaural' => 1,
            'needs_video' => 1,
            'project_id' => 1,
            'weekday_id' => 5,
            'status_id' => 2,
        ]);

        $this->call([
            QuestionsSeeder::class,
        ]);

    }
    
}
