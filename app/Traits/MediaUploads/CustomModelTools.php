<?php


namespace App\Traits\MediaUploads;


trait CustomModelTools
{
  public function getMediaProperties()
  {
    return [
      'profile' => ['type' => 'image', 'count' => 2],
      'resimler' => ['type' => 'multi_image', 'count' => 2]
    ];
  }
}
