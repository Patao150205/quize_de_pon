<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailVerificationsTable extends Migration
{
    public function up()
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->string('token', 255);
            $table->dateTime('expiration_datetime');
            $table->string('name');
            $table->string('password');
            $table->timestamps();
            $table->index(['email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_verifications');
    }
}
