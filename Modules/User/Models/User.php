<?php

namespace Modules\User\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends Model implements HasMedia
{
  use Notifiable, Relations, SourceSettings, MediaUploads, SoftDeletes;
  
  protected $guarded = ['id', 'email_verified_at', 'created_at', 'updated_at', 'deleted_at'];
  
  private $path = 'Modules\User\Source\User.json';
}
