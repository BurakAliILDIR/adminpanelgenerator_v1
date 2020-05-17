<?php

namespace App\Traits\ModelTraits;

trait Booting
{
  use UUID;
  
  protected static function booted()
  {
    self::bootGenerateUUID();
  }
}
