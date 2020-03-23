<?php

namespace Modules\Deneme\Entities;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;


class Deneme extends Model implements HasMedia
{
  use Relations, SourceSettings, MediaUploads, SoftDeletes;
  
  protected $guarded = [];
  protected $table = 'deneme';
  
  private $path = '\\Modules\\Deneme\\Source\\deneme.json';
}
