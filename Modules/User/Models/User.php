<?php

namespace Modules\User\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use App\Traits\ModelTraits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
  use Notifiable, UUID, Relations, SourceSettings, HasRoles, MediaUploads, SoftDeletes;
  
  protected $keyType = 'string';
  
  public $incrementing = false;
  
  protected $guarded = ['email_verified_at', 'created_at', 'updated_at', 'deleted_at'];
  
  private $path = 'Modules\User\Source\User.json';
  
  protected $hidden = ['password'];
  
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
}
