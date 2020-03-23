<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateModule extends Command
{
  protected $signature = 'module:create {name: Module adı giriniz.}';
  
  protected $description = 'Yeni bir module oluşturma.';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    // girilen değeri alma.
    $name = $this->argument('name');
    // gelen tüm değerleri array olarak alma
    // $arguments = $this->arguments();
    
    $this->info($name);
    Artisan::call('module:make ' . $name);
    Artisan::call('module:make-model ' . $name . ' ' . $name . ' -m');
    Artisan::call('module:create-request ' . $name . ' ' . $name . ' Create');
    Artisan::call('module:create-request ' . $name . ' ' . $name . ' Edit');
    
  }
}
