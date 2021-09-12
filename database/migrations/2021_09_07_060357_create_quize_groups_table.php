<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quize_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('information');
            $table->unsignedTinyInteger('has_content')->default(0);
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('category_id')->constrained();
            $table->index(['category_id', 'user_id']);
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
        Schema::dropIfExists('quize_groups');
    }
}
