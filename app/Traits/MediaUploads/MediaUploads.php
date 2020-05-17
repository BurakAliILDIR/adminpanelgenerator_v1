<?php

namespace App\Traits\MediaUploads;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

Trait MediaUploads
{
  use HasMediaTrait;
  
  private function image_size_format($key, $count)
  {
    $this->addMediaCollection($key)
      ->acceptsFile(function (File $file) {
        return (($file->mimeType === 'image/jpeg') ||
          ($file->mimeType === 'image/jpg') ||
          ($file->mimeType === 'image/png'));
      })->onlyKeepLatest($count)
      ->registerMediaConversions(function (Media $media) {
        $this
	        ->addMediaConversion('thumb')
	        ->fit(Manipulations::FIT_CONTAIN, 120, 120);
	      $this
		      ->addMediaConversion('card')
		      ->fit(Manipulations::FIT_CONTAIN, 440, 260);
        $this
          ->addMediaConversion('big')
          ->fit(Manipulations::FIT_CONTAIN, 1283, 734);
      });
  }
  
  public function registerMediaCollections()
  {
    $fields = $this->getSettings('fields');
    foreach ($fields as $key => $val) {
      if ($val['type'] === 'multi_image')
        $this->image_size_format($key, $val['count']);
      else if ($val['type'] === 'image')
        $this->image_size_format($key, 1);
      else
        $this->addMediaCollection($key)->onlyKeepLatest(1);
    }
  }
}
