<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenemeTable extends Migration
{
    public function up()
    {
        Schema::create('deneme', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ad');
            $table->string('soyad');
            $table->string('yas');
            $table->unsignedBigInteger('count_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deneme');
    }
}
