<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\Models\Activity;

class TraceClear extends Command
{
  protected $signature = 'trace:clear';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    $my_id = Crypt::decryptString(config('my-config.super_admin_id'));
    Activity::where('causer_id', $my_id)->orWhereNull('causer_id')->delete();
  }
}
