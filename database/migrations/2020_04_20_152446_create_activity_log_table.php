<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
  public function up()
  {
    Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('log_name')->nullable();
      $table->text('description');
      $table->uuid('subject_id')->index()->nullable();
      $table->string('subject_type')->nullable();
      $table->uuid('causer_id')->index()->nullable();
      $table->string('causer_type')->nullable();
      $table->json('properties')->nullable();
      $table->timestamps();
      
      $table->index('log_name');
      $table->index(['subject_id', 'subject_type'], 'subject');
      $table->index(['causer_id', 'causer_type'], 'causer');
    });
  }
  
  public function down()
  {
    Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
  }
}
