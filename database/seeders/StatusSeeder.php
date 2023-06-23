<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert([
            ['id' => 1, 'nome' => 'ativo', 'descricao' => 'habilitado e em atividade'],
            ['id' => 2, 'nome' => 'inativo', 'descricao' => 'atividade encerrada'],
            ['id' => 3, 'nome' => 'deletado', 'descricao' => 'registro deletado']
        ]);
    }
}
