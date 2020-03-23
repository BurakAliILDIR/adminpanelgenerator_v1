<?php


namespace App\Traits\ModelTraits;


trait SourceSettings
{
  public function getSettings($key = null)
  {
    $json = json_decode(file_get_contents(base_path($this->path)), true);
    return $key ? $json[$key] : $json;
  }
}
