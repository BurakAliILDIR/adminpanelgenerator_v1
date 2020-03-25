<?php


namespace App\Traits\MediaUploads;


use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

Trait MediaUploads
{
  use HasMediaTrait;
  
  private function image_size_format($key, $count)
  {
    $this
      ->addMediaCollection($key)
      ->acceptsFile(function (File $file) {
        return (($file->mimeType === 'image/jpeg') ||
          ($file->mimeType === 'image/jpg') ||
          ($file->mimeType === 'image/png'));
      })->onlyKeepLatest($count)
      ->registerMediaConversions(function (Media $media) {
        $this
          ->addMediaConversion('thumb')
          ->width(120)
          ->height(120);
        $this
          ->addMediaConversion('card')
          ->width(440)
          ->height(220);
        $this
          ->addMediaConversion('big')
          ->width(1283)
          ->height(734);
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
