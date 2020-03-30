<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BuildProject extends Command
{
  protected $signature = 'build';
  
  protected $description = 'Proje temel ayarlarını kurar.';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    Artisan::call('migrate:refresh --seed');
  }
}
