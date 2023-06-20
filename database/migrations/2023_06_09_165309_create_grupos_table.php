<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projeto_id')->constrained();
            $table->string('nome');
            $table->char('numero');
            $table->text('descricao');
            $table->integer('max_participantes');
            $table->foreignId('oficina_dia')->constrained(table: 'dias', column: 'id')->nullable();
            $table->time('oficina_horario');
            $table->foreignId('status_id')->constrained(table: 'status', column: 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
