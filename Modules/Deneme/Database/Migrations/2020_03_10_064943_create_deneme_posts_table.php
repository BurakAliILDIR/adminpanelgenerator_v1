<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenemePostsTable extends Migration
{
    public function up()
    {
        Schema::create('deneme_post', function (Blueprint $table) {
            $table->unsignedBigInteger('deneme_id');
            $table->unsignedBigInteger('post_id');
            $table->foreign('deneme_id')->references('id')->on('deneme')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deneme_post');
    }
}
