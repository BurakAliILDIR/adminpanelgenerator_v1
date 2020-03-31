<?php


namespace App\Traits\MigrationTraits;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait BelongsToManyTableSettings
{
  private function belongsToManyCreate() : void
  {
    foreach ($this->fields as $key => $field) {
      switch ($field['type']) {
        case 'multi_checkbox':
        case 'multi_select':
          if (($relation = $field['relationship'])['type'] === 'belongsToMany' && !Schema::hasTable(($keys = $relation['keys'])['table'])) {
            Schema::create($keys['table'], function (Blueprint $table) use ($keys) {
              $table->uuid($keys['foreignKey'])->index();
              $table->uuid($keys['otherKey'])->index();
            });
          }
          break;
      }
    }
  }
  
  private function belongsToManyDown() : void
  {
    foreach ($this->fields as $key => $field) {
      switch ($field['type']) {
        case 'multi_checkbox':
        case 'multi_select':
          if (($relation = $field['relationship'])['type'] === 'belongsToMany' && !Schema::hasTable(($keys = $relation['keys'])['table'])) {
            Schema::dropIfExists($keys['table']);
          }
          break;
      }
    }
  }
}
