<?php


namespace App\Traits\ModelTraits;


use Illuminate\Support\Str;

trait UUID
{
  protected static function boot()
  {
    parent::boot();
    
    static::creating(function ($model) {
      $model->{$model->getKeyName()} = (string) Str::orderedUuid();
    });
  }
}
