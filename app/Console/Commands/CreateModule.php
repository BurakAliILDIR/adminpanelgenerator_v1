<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Facades\Module;

class CreateModule extends Command
{
  protected $signature = 'module:create {name}';
  
  protected $description = 'Yeni bir module oluşturma.';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    //$Name = $this->argument('name');
    //$ModelName = $this->argument('model');
    
    //dump('Modül Adı : ' . $Name);
    
    //Artisan::call('module:make ' . $Name . " --force");
    //Artisan::call('module:make-model ' . $ModelName . ' ' . $Name);
//    $Folders = [
//      "deneme_config" => ["path" => "DenemeConfig"],
//      "deneme_console" => ["path" => "DenemeConsole"]
//    ];
//    $Modul = Module::find($Name);
//    foreach ($Folders as $key => $folder){
//      $Path = $Modul->getPath() . "/" . $folder["path"];
//        dump($Path);
//        File::makeDirectory($Path);
////        Storage::makeDirectory($Path);
//    }
    //Artisan::call('module:make-request Create'. $Name.'Request ' . $Name);
    //Artisan::call('module:make-request Edit'. $Name.'Request ' . $Name);
    
    
    // girilen değeri alma.
    $name = $this->argument('name');
    // gelen tüm değerleri array olarak alma
    // $arguments = $this->arguments();
    
    Artisan::call('module:make ' . $name);
    Artisan::call('module:make-model ' . $name . ' ' . $name . ' -m');
    Artisan::call('module:create-request ' . $name . ' ' . $name . ' Create');
    Artisan::call('module:create-request ' . $name . ' ' . $name . ' Edit');
    
  }
}
