<?php

namespace Modules\Deneme\Entities;

use App\Traits\ModelTraits\Relations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Relations;

    private $path = '\Modules\Deneme\Source\post.json';
  
  public function getSettings($key = null)
  {
    $json = json_decode(file_get_contents(base_path($this->path)), true);
    return $key ? $json[$key] : $json;
  }
}
