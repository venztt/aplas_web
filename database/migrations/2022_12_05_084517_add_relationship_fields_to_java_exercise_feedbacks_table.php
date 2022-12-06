<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJavaExerciseFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('java_exercise_feedbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('java_exercise_id')->nullable();
            $table->foreign('java_exercise_id', 'java_exercise_fk_5521342')->references('id')->on('java_exercises');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5521232')->references('id')->on('users');
        });
    }
}
