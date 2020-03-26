<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->index()->unique()->primary();
      $table->string('name', 50)->nullable()->index();
      $table->string('surname', 50)->nullable()->index();
      $table->string('email', 150)->unique()->index();
      $table->string('password');
      $table->text('bio')->nullable();
      $table->string('phone', 15)->nullable();
      $table->string('gender', 15)->nullable()->index();
      $table->date('date_of_birth')->nullable()->index();
      $table->boolean('confirm')->default(0)->index();
      $table->dateTime('email_verified_at')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
