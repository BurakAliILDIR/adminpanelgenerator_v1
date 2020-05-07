<?php

namespace App\Traits\ModelTraits;

use App\Traits\ElasticSearch\ElasticModelTrait;

trait Booting
{
  use UUID;
  
  protected static function booted()
  {
    self::bootGenerateUUID();
  }
}
