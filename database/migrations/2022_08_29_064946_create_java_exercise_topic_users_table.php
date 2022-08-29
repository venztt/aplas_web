<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJavaExerciseTopicUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('java_exercise_topic_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_path')->nullable();
            $table->longText('raw')->nullable();
            $table->string('status')->nullable();
            $table->longText('report')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
