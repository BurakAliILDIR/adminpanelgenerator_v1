<?php

namespace App\Models;

use App\Traits\MediaUploads\CustomModelTools;
use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
use App\Traits\ModelTraits\UUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
  use Notifiable, CausesActivity, LogsActivity, Relations, UUID, HasRoles, SourceSettings, MediaUploads, CustomModelTools, SoftDeletes;
  
  private $source = 'User.json';
  
  // kendi media ayar dizisini kullanacağı için. CustomModelTools ile beraber kullanılır.
  private $customMediaUploads = true;
  
  protected $keyType = 'string';
  
  public $incrementing = false;
  
  protected $guarded = ['email_verified_at', 'created_at', 'updated_at', 'deleted_at'];
  
  protected $hidden = ['password'];
  
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  
  protected static $logUnguarded = true;
  protected static $logAttributes = ['remember_token', 'password'];
  protected static $submitEmptyLogs = false;
  protected static $logOnlyDirty = true;
}
