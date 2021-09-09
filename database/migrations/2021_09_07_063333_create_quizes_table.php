<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizes', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('choice1');
            $table->string('choice2');
            $table->string('choice3');
            $table->string('choice4');
            $table->char('answer_choice', 7);
            $table->text('explanation')->nullable();
            $table->unsignedTinyInteger('sort_num');
            $table->foreignId('quize_group_id')->index('group')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('question_image_id')->nullable()->constrained('images');
            $table->foreignId('explanation_image_id')->nullable()->constrained('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizes');
    }
}
