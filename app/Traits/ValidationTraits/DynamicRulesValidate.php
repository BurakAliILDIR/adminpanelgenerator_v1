<?php

namespace App\Traits\ValidationTraits;

use Illuminate\Support\Facades\Redis;

trait DynamicRulesValidate
{
  public function rules()
  {
    $validates = [];
    foreach ($this->fields as $key => $field) {
      $validates[$key] = implode('|', $rules ?? []);
    }
    return $validates;
  }
  
  public function attributes()
  {
    $attributes = [];
    foreach ($this->fields as $key => $field) {
      $attributes[$key] = $field['title'];
    }
    return $attributes;
  }
  
  // Redisten veya ilgili modelden aldığı veriler ile global düzeydeki $fields ı doldurur.
  private function fillFields(string $name, string $operation) : void
  {
    $redis_path = config('cache.prefix') . ":$name:Json:$operation";
    if ( !($this->fields = unserialize(Redis::get($redis_path))['showFields'])) {
      $model = '\\Modules\\' . $name . '\\Models\\' . $name;
      $this->fields = (new $model())->getSettings('fields');
      Redis::set($redis_path, serialize($this->fields));
    }
  }
}
