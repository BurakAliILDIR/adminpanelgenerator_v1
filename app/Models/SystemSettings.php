<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
	public $incrementing = false;
	public $timestamps = false;
	protected $primaryKey = 'key';
	protected $keyType = 'string';
	protected $table = 'system_settings';
	protected $guarded = ['key'];
}
