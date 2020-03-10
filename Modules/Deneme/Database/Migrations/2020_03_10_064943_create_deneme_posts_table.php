<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenemePostsTable extends Migration
{
    public function up()
    {
        Schema::create('deneme_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('deneme_id');
            $table->unsignedBigInteger('post_id');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deneme_post');
    }
}
