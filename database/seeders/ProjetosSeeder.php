<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('projetos')->insert([
            [
                'nome' => "Projeto Oficinas Binaurais 2023.2",
                'descricao' => 'Projeto desenvolvido no segundo semestre de 2023',
                'contato' => 'NAE',
                'inicio' => '2023-06-01',
                'fim' => '2023-10-01',
                'status_id' => 1,
            ],
            [
                'nome' => "Projeto Oficinas Binaurais 2024.1",
                'descricao' => 'Projeto desenvolvido no primeiro semestre de 2024',
                'contato' => 'NAE',
                'inicio' => '2024-04-01',
                'fim' => '2024-07-01',
                'status_id' => 2,
            ]
        ]);
    }
    
}
