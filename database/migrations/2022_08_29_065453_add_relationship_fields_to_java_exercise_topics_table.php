<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJavaExerciseTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('java_exercise_topics', function (Blueprint $table) {
            $table->unsignedBigInteger('java_exercise_id')->nullable();
            $table->foreign('java_exercise_id', 'java_exercise_fk_5323342')->references('id')->on('java_exercises');
        });
    }
}
