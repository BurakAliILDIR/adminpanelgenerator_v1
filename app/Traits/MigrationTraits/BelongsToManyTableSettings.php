<?php


namespace App\Traits\MigrationTraits;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait BelongsToManyTableSettings
{
  private function belongsToManyDown() : void
  {
    foreach ($this->fields as $key => $field) {
      if ($field['type'] === 'multi_checkbox' && ($relation = $field['relationship'])['type'] === 'belongsToMany' && !Schema::hasTable(($keys = $relation['keys'])['table'])) {
        Schema::dropIfExists($keys['table']);
      };
    }
  }
  
  private function belongsToManyCreate() : void
  {
    foreach ($this->fields as $key => $field) {
      if ($field['type'] === 'multi_checkbox' && ($relation = $field['relationship'])['type'] === 'belongsToMany' && !Schema::hasTable(($keys = $relation['keys'])['table'])) {
        Schema::create($keys['table'], function (Blueprint $table) use ($keys) {
          $table->unsignedBigInteger($keys['foreignKey']);
          $table->unsignedBigInteger($keys['otherKey']);
        });
      }
    }
  }
}
