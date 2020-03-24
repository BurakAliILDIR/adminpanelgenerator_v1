<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
  use \App\Traits\MigrationTraits\BelongsToManyTableSettings;
  private $fields = null;
  
  public function __construct()
  {
    $name = substr('CreateBlogsTable', 6, -6);
    $model = '\\Modules\\' . $name . '\\Models\\' . $name;
    $this->fields = (new $model())->getSettings('fields');
  }
  
  public function up()
  {
    Schema::create('blogs', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->softDeletes();
      foreach ($this->fields as $key => $field) {
        switch ($type = $field['type']) {
          case 'radio':
          case 'email':
          case 'text':
          case 'password':
            $table->string($key)->nullable()->index();
            break;
          case 'hidden':
            if ($key !== 'id') $table->string($key)->nullable();
            break;
          case 'checkbox':
            $table->boolean($key)->default(0);
            break;
          case 'number':
            $table->decimal($key)->nullable()->index();
            break;
          case 'select':
            $table->unsignedBigInteger($key)->nullable();
            break;
          case 'textarea':
            $table->longText($key)->nullable();
            break;
          case 'date':
            $table->date($key)->nullable()->index();
            break;
          case 'datetime':
            if ($key !== 'created_at' && $key !== 'updated_at')
              $table->dateTime($key)->nullable()->index();
            break;
        }
      }
    });
    $this->belongsToManyCreate();
  }
  
  public function down()
  {
    $this->belongsToManyDown();
    Schema::dropIfExists('blogs');
  }
}
