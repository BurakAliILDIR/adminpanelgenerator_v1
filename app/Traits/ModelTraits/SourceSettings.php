<?php


namespace App\Traits\ModelTraits;


trait SourceSettings
{
  public function getSettings($key = null)
  {
    $json = json_decode(file_get_contents(storage_path('app/modules/sources/' . $this->source)), true);
    return $key ? $json[$key] : $json;
  }
}
