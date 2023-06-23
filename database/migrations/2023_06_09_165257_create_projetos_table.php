<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->text('contato');
            $table->date('inicio');
            $table->date('fim')->nullable();
            $table->foreignId('status_id')->constrained(table: 'status', column: 'id');
            $table->timestamps();
        });

        Artisan::call( 'db:seed', [
            '--class' => 'ProjetosSeeder',
            '--force' => true ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
