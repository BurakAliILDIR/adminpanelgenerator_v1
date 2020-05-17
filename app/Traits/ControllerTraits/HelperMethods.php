<?php

namespace App\Traits\ControllerTraits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

trait HelperMethods
{
  private function many_to_many_sync(Request $request, $fields, $operation_type) : void
  {
    foreach ($fields as $key => $field) {
      if ( !$field[$operation_type]) continue;
      switch ($field['type']) {
        case 'multi_select':
        case 'multi_checkbox':
          $this->model->relation($field['relationship'])->sync($request[$key]);
          break;
      }
    }
  }
  
  private function insertToSingleMedia(Request $request, $name, $model) : void
  {
    if ($request->hasFile($name))
      $model->addMedia(\request($name))
        ->sanitizingFileName(function ($fileName) {
          return str_replace(['#', '/', '\\', ' ', '\'', '!', '&', '|', '(', ')', '<', '>',
            '%', '$', '£', 'ß', 'æ', '{', '}', '[', ']', '?', '=', '*', '+', '½', ',',
            '~', 'ğ', 'İ', 'ı', '-', 'ç', 'ş', 'ü', 'ö', '_'],
            '', Str::kebab($fileName));
        })
        ->preservingOriginal()
        ->toMediaCollection($name);
  }
  
  private function getPluck($operation_type) : array
  {
    $plucks = [];
    foreach ($this->jsonSettings['fields'] as $key => $field) {
	    if ($field[$operation_type] && @($relation = $field['relationship']) && $field['type'] !== 'auth')
		    $plucks[$key] = (new $relation['model'])->pluck($relation['pluck']['display'], $relation['pluck']['value']);
    }
    return $plucks;
  }
  
  // Settings json çekme ve işlemeleri (Aşağıdaki 3 fonksiyon)
  private function readFieldsPick($page) : array
  {
	  $dbTypes = ['text', 'checkbox', 'date', 'datetime', 'email', 'number', 'radio', 'hidden', 'password', 'textarea'];
	
	  $showFields = [];
	  $dbSelectFields = [];
	  foreach ($this->jsonSettings['fields'] as $key => $field) {
		  if ($field[$page]) {
			  $showFields[$key] = $field;
			  if (in_array($field['type'], $dbTypes)) {
				  array_push($dbSelectFields, $key);
			  } 
			  if ($field['type'] === 'select' || $field['type'] === 'auth') {
				  if (($relation = @$field['relationship'])) {
					  if (($relation['type'] === 'hasOne' || $relation['type'] === 'hasMany')) {
						  array_push($dbSelectFields, $key);
					  }
				  } else
					  array_push($dbSelectFields, $key);
			  }
		  }
	  }
	  return ['showFields' => $showFields, 'dbSelectFields' => $dbSelectFields];
  }
  
  private function redisReadFields(string $operation_type)
  {
	  $key = "$this->redis_path:Json:$operation_type";
	  if ( !($fields = unserialize(Redis::get($key)))) {
		  $fields = $this->readFieldsPick($operation_type);
		  Redis::set($key, serialize($fields));
	  }
	  return $fields;
  }
  
  private function redisJsonSettings() : void
  {
    $key = "$this->redis_path:Json:all";
    if ( !($this->jsonSettings = unserialize(Redis::get($key)))) {
      $json = $this->model->getSettings();
      Redis::set($key, serialize($json));
      $this->jsonSettings = $json;
    }
  }
}
