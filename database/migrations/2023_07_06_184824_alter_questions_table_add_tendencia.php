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
        Schema::create('question_tendencies', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->unsigned();
            $table->string('name', 255);
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->tinyInteger('tendency_id')->unsigned();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('tendency_id')->references('id')->on('question_tendencies');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->dropForeign(['tendency_id']);
            });

            Schema::table('questions', function (Blueprint $table) {
                $table->dropColumn('tendency_id');
            }); 

        }

        Schema::dropIfExists('question_tendencies');

    }
};
