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
            $table->text('hakkimda');
            $table->boolean('durum');
            $table->string('yas');
            $table->unsignedBigInteger('count_id');
            $table->date('datee');
            $table->dateTime('dateetime');
            $table->string('cinsiyet');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deneme');
    }
}
