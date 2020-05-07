<?php

namespace Modules\Blog\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Booting;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class Blog extends Model implements HasMedia
{
  use Booting, Relations, SourceSettings, MediaUploads, LadaCacheTrait, HasSlug, LogsActivity, SoftDeletes;

  protected $table = 'Blog';
  
  protected $keyType = 'string';

  public $incrementing = false;

  protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
  
  private $source = 'Blog.json';
  
  public function getSlugOptions() : SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom($this->getSettings('slugs'))
      ->saveSlugsTo('slug');
  }
  
  protected static $logUnguarded = true;
  protected static $submitEmptyLogs = false;
  protected static $logOnlyDirty = true;
}
