<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJavaExerciseTopicUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('java_exercise_topic_users', function (Blueprint $table) {
            $table->unsignedBigInteger('java_exercise_topic_id')->nullable();
            $table->foreign('java_exercise_topic_id', 'java_exercise_topic_fk_5323232')->references('id')->on('java_exercise_topics');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5323232')->references('id')->on('users');
        });
    }
}
