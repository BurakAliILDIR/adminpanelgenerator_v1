<?php

namespace App\Models;

use App\Traits\MediaUploads\MediaUploads;
use App\Traits\ModelTraits\Booting;
use App\Traits\ModelTraits\Relations;
use App\Traits\ModelTraits\SourceSettings;
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
  use Booting, Notifiable, CausesActivity, LogsActivity, Relations, HasRoles, SourceSettings, MediaUploads, SoftDeletes;
  
  private $source = 'User.json';
  
  protected $keyType = 'string';
  
  public $incrementing = false;
  
  protected $guarded = ['email_verified_at', 'created_at', 'updated_at', 'deleted_at', 'remember_token'];
  
  protected $hidden = ['remember_token', 'password'];
  
  protected $casts = ['email_verified_at' => 'datetime', 'date_of_birth' => 'date',];
  
  protected static $logUnguarded = true;
  protected static $submitEmptyLogs = false;
  protected static $logOnlyDirty = true;
}
