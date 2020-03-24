<?php

namespace Modules\Permission\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use App\Traits\ModelTraits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Permission extends Model
{
  use Relations, SourceSettings;
  
  protected $guarded = ['id', 'created_at', 'updated_at'];
  
  private $path = 'Modules\Permission\Source\Permission.json';
}
