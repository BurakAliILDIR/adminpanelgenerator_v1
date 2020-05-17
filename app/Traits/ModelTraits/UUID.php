<?php

namespace App\Traits\ModelTraits;

use Illuminate\Support\Str;

trait UUID
{
  protected static function bootGenerateUUID()
  {
    static::creating(function ($model) {
      $model->{$model->getKeyName()} = (string)Str::orderedUuid();
    });
  }
}
