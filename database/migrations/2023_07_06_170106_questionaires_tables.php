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


        Schema::create('questions', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unsigned();
            $table->string('text', 255);
            $table->tinyInteger('question_type_id')->unsigned();
        });

        Schema::create('question_types', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->unsigned();
            $table->string('name', 255);
        });

        Schema::create('question_options', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unsigned();
            $table->smallInteger('question_id')->unsigned();
            $table->string('text', 255);
        });

        /** Atenção, aqui a chave estrangeira é chave primária... cada questão tem um range único */
        Schema::create('question_range', function (Blueprint $table) {
            $table->smallInteger('question_id')->unsigned();
            $table->tinyInteger('min');
            $table->tinyInteger('max');
            $table->primary(['question_id']);
        });

        Schema::create('questionaires', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->unsigned();
            $table->string('name', 255);
            $table->string('description', 500);
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('questionaire_questions', function (Blueprint $table) {
            $table->tinyInteger('questionaire_id')->unsigned();
            $table->smallInteger('question_id')->unsigned();
        });

        Schema::create('project_questionaires', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unsigned();
            $table->tinyInteger('questionaire_id')->unsigned();
            $table->tinyInteger('project_id')->unsigned();
            $table->tinyInteger('interval')->unsigned();
            $table->boolean('before');
            $table->string('description', 500)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('group_questionaires', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unsigned();
            $table->tinyInteger('questionaire_id')->unsigned();
            $table->smallInteger('group_id')->unsigned();
            $table->tinyInteger('interval')->unsigned();
            $table->boolean('before');
            $table->string('description', 500)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('questionaire_answers', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('gpmember_workshop_id')->unsigned();
            $table->smallInteger('group_questionaire_id')->unsigned();
            $table->smallInteger('question_id')->unsigned();
            $table->string('answer', 255);
        });




        /**  CHAVES */

        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('question_type_id')->references('id')->on('question_types');
        });

        Schema::table('questionaire_questions', function (Blueprint $table) {
            $table->foreign('questionaire_id')->references('id')->on('questionaires')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('question_range', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('project_questionaires', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('questionaire_id')->references('id')->on('questionaires')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('group_questionaires', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('questionaire_id')->references('id')->on('questionaires')->onDelete('restrict')->onUpdate('restrict');        });

        Schema::table('questionaire_answers', function (Blueprint $table) {
            $table->foreign('gpmember_workshop_id')->references('id')->on('group_member_workshop')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('group_questionaire_id')->references('id')->on('group_questionaires')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('restrict')->onUpdate('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        

        if (Schema::hasTable('questions')) {
            Schema::table('questions', function (Blueprint $table) {
                $table->dropForeign(['question_type_id']);
            });
        }

        if (Schema::hasTable('questionaire_questions')) {
            Schema::table('questionaire_questions', function (Blueprint $table) {
                $table->dropForeign(['questionaire_id'])->references('id')->on('questionaires')->onDelete('restrict')->onUpdate('restrict');
                $table->dropForeign(['question_id'])->references('id')->on('questions')->onDelete('restrict')->onUpdate('restrict');
            });
        }

        if (Schema::hasTable('question_range')) {
            Schema::table('question_range', function (Blueprint $table) {
                $table->dropForeign(['question_id']);
            });
        }

        if (Schema::hasTable('question_options')) {
            Schema::table('question_options', function (Blueprint $table) {
                $table->dropForeign(['question_id']);
            });
        }

        if (Schema::hasTable('project_questionaires')) {
            Schema::table('project_questionaires', function (Blueprint $table) {
                $table->foreign(['project_id']);
                $table->foreign(['questionaire_id']);
            });
        }

        if (Schema::hasTable('group_questionaires')) {
            Schema::table('group_questionaires', function (Blueprint $table) {
                $table->dropForeign(['group_id']);
                $table->dropForeign(['questionaire_id']);        
            });
        }

        if (Schema::hasTable('group_member_questionaire_answers')) {
            Schema::table('group_member_questionaire_answers', function (Blueprint $table) {
                $table->dropForeign(['group_member_workshop_id']);
                $table->dropForeign(['group_questionaire_id']);
                $table->dropForeign(['question_id']);
            });
        }


        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_types');
        Schema::dropIfExists('question_range');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('questionaires');
        Schema::dropIfExists('questionaire_questions');
        Schema::dropIfExists('project_questionaires');
        Schema::dropIfExists('group_questionaires');
        Schema::dropIfExists('questionaire_answers');

    }
};
