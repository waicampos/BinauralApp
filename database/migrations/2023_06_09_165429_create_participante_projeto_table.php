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
        Schema::create('participante_projeto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('projeto_id')->constrained();
            $table->foreignId('grupo_id')->constrained();
            $table->string('playlist_url')->nullable();
            $table->boolean('autoriza_uso_dados');
            $table->foreignId('status_id')->constrained(table: 'status', column: 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participante_projeto');
    }
};
