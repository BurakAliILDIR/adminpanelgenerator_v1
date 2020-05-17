<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
	public function up()
	{
		Schema::create('system_settings', function (Blueprint $table) {
			$table->string('key')->primary()->index();
			$table->string('value')->nullable();
		});
	}
	
	public function down()
	{
		Schema::dropIfExists('system_settings');
	}
}
