<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJavaExerciseFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('java_exercise_feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('suggestions')->nullable();
            $table->longText('adding_material')->nullable();
            $table->longText('others')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
