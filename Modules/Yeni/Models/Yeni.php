<?php

namespace Modules\Yeni\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Yeni extends Model implements HasMedia
{
  use Relations, SourceSettings, MediaUploads, SoftDeletes;
  
  protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
  
  private $path = 'Modules\Yeni\Source\Yeni.json';
}
