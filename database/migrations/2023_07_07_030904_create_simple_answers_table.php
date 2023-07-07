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

        Schema::create('simple_answers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->smallInteger('group_member_id')->unsigned();
            $table->string('question', 255);
            $table->string('answer', 255);
            $table->timestamps();
        });

        Schema::table('simple_answers', function (Blueprint $table) {
            $table->foreign('group_member_id')->references('id')->on('group_member');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('simple_answers')) {
            Schema::table('simple_answers', function (Blueprint $table) {
                $table->dropFreign('group_member_id');
            });
        }

        Schema::dropIfExists('simple_answers');
    }
};
