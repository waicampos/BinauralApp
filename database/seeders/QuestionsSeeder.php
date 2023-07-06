<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('questions')->delete();
        DB::table('question_types')->delete();
        DB::table('question_range')->delete();
        DB::table('question_options')->delete();
        DB::table('questionaires')->delete();
        DB::table('questionaire_questions')->delete();
        DB::table('project_questionaires')->delete();
        DB::table('group_questionaires')->delete();
        DB::table('questionaire_answers')->delete();
        DB::table('question_tendencies')->delete();
            
        DB::table('question_types')->insert([
            ['id' => 1, 'name' => 'range'],
            ['id' => 2, 'name' => 'select'],
            ['id' => 3, 'name' => 'checklist'],
            ['id' => 4, 'name' => 'text']
        ]);

        DB::table('question_tendencies')->insert([
            ['id' => 1, 'name' => 'Geral'],
            ['id' => 2, 'name' => 'Ansiosa'],
            ['id' => 3, 'name' => 'Depressiva'],
            ['id' => 4, 'name' => 'Dificuldade em relaxar e dormir'],
            ['id' => 5, 'name' => 'Desatenção e sem foco'],
            ['id' => 6, 'name' => 'Dificuldade para resolver problemas e criatividade']
        ]);

        DB::table('questions')->insert([
            ['id' => 1, 'question_type_id' => 2, 'tendency_id' => 1, 'text' => 'Como você está se sentindo hoje?'],
            ['id' => 2, 'question_type_id' => 2, 'tendency_id' => 1, 'text' => 'Como você se sente depois da experiência?'],
            ['id' => 3, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Dificuldade para relaxar'],
            ['id' => 4, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Dificuldade para controlar os pensamentos'],
            ['id' => 5, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Pensa em muitas coisas ao mesmo tempo'],
            ['id' => 6, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Tem pensamentos caóticos de que o pior vai acontecer'],
            ['id' => 7, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Sensação de que vai perder o controle'],
            ['id' => 8, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Fica nervoso com facilidade'],
            ['id' => 9, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Tremores ou dormência nas pernas e/ou nas mãos'],
            ['id' => 10, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Palpitação e/ou coração acelerado'],
            ['id' => 11, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Sensação de estar sufocando e/ou dificuldade para respirar'],
            ['id' => 12, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Indigestão ou desconforto abdominal'],
            ['id' => 13, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Desmaio'],
            ['id' => 14, 'question_type_id' => 1, 'tendency_id' => 2, 'text' => 'Tontura ou falta de equilíbrio'],
        ]);

        DB::table('question_options')->insert([
            ['id' => 1, 'question_id' => 1, 'text' => 'Bem e com disposição'],
            ['id' => 2, 'question_id' => 1, 'text' => 'Ansioso'],
            ['id' => 3, 'question_id' => 1, 'text' => 'Depressivo'],
            ['id' => 4, 'question_id' => 1, 'text' => 'Dificuldade para relaxar ou dormir'],
            ['id' => 5, 'question_id' => 1, 'text' => 'Desatento e sem foco'],
            ['id' => 6, 'question_id' => 1, 'text' => 'Dificuldade para resolver problemas ou estudo'],
            ['id' => 7, 'question_id' => 1, 'text' => 'Outro'],
            ['id' => 8, 'question_id' => 2, 'text' => 'Relaxado'],
            ['id' => 9, 'question_id' => 2, 'text' => 'Alegre'],
            ['id' => 10, 'question_id' => 2, 'text' => 'Concentrado'],
            ['id' => 11, 'question_id' => 2, 'text' => 'Atento'],
            ['id' => 12, 'question_id' => 2, 'text' => 'Eufórico'],
            ['id' => 13, 'question_id' => 2, 'text' => 'Sem alteração da sensação inicial'],
            ['id' => 14, 'question_id' => 2, 'text' => 'Outro']
        ]);

        DB::table('questionaires')->insert([
            ['id' => 1, 'name' => 'Escolha como você se sente agora', 'description' => ''],
            ['id' => 2, 'name' => 'Escolha como você se sente depois da experiência', 'description' => ''],
            ['id' => 3, 'name' => 'Como estão as suas sensações', 'description' => 'Tendência Ansiosa - questãos com escala']
        ]);

        DB::table('questionaire_questions')->insert([
            ['questionaire_id' => 1, 'question_id' => 1],
            ['questionaire_id' => 2, 'question_id' => 2],
            ['questionaire_id' => 3, 'question_id' => 3],
            ['questionaire_id' => 3, 'question_id' => 4],
            ['questionaire_id' => 3, 'question_id' => 5],
            ['questionaire_id' => 3, 'question_id' => 6],
            ['questionaire_id' => 3, 'question_id' => 7],
            ['questionaire_id' => 3, 'question_id' => 8],
            ['questionaire_id' => 3, 'question_id' => 9],
            ['questionaire_id' => 3, 'question_id' => 10],
            ['questionaire_id' => 3, 'question_id' => 11],
            ['questionaire_id' => 3, 'question_id' => 12],
            ['questionaire_id' => 3, 'question_id' => 13],
            ['questionaire_id' => 3, 'question_id' => 14],
        ]);

        DB::table('group_questionaires')->insert([
            ['id' => 1, 'group_id' => 1, 'questionaire_id' => 1, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 2, 'group_id' => 1, 'questionaire_id' => 2, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 3, 'group_id' => 1, 'questionaire_id' => 3, 'interval' => 1, 'before' => 0, 'description' => ''],

            ['id' => 4, 'group_id' => 2, 'questionaire_id' => 1, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 5, 'group_id' => 2, 'questionaire_id' => 2, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 6, 'group_id' => 2, 'questionaire_id' => 3, 'interval' => 1, 'before' => 0, 'description' => ''],

            ['id' => 7, 'group_id' => 3, 'questionaire_id' => 1, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 8, 'group_id' => 3, 'questionaire_id' => 2, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 9, 'group_id' => 3, 'questionaire_id' => 3, 'interval' => 1, 'before' => 0, 'description' => ''],

            ['id' => 10, 'group_id' => 4, 'questionaire_id' => 1, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 11, 'group_id' => 4, 'questionaire_id' => 2, 'interval' => 1, 'before' => 1, 'description' => ''],
            ['id' => 12, 'group_id' => 4, 'questionaire_id' => 3, 'interval' => 1, 'before' => 0, 'description' => ''],
        ]);

    }
}
