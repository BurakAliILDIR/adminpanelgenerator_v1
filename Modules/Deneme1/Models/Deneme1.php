<?php

namespace Modules\Deneme1\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use App\Traits\ModelTraits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Deneme1 extends Model implements HasMedia
{
  use Relations, UUID, SourceSettings, MediaUploads, \Spiritix\LadaCache\Database\LadaCacheTrait, HasSlug, SoftDeletes;

  protected $table = 'Deneme1';
  
  protected $keyType = 'string';

  public $incrementing = false;

  protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
  
  private $path = 'Modules\Deneme1\Source\Source.json';
  
  public function getSlugOptions() : SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom($this->getSettings('slugs'))
      ->saveSlugsTo('slug');
  }
}
