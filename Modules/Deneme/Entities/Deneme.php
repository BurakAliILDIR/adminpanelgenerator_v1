<?php

namespace Modules\Deneme\Entities;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Deneme extends Model implements HasMedia
{
  use Relations, MediaUploads, SoftDeletes;
  
  protected $guarded = [];
  protected $table = 'deneme';
  /* TODO 1:  */
  
  private $path = '\Modules\Deneme\Source\deneme.json';
  
  public function getSettings($key = null)
  {
    $json = json_decode(file_get_contents(base_path($this->path)), true);
    return $key ? $json[$key] : $json;
  }
}
