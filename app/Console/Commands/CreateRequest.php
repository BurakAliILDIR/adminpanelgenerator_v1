<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Exceptions\FileAlreadyExistException;
use Nwidart\Modules\Generators\FileGenerator;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;

class CreateRequest extends Command
{
  protected $signature = 'module:create-request {name} {module} {type}';
  
  protected $description = 'Belirtilen module ve model için request nesnesi oluşturun.';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function handle()
  {
    $this->info($this->argument('name'));
    $name = Str::studly($this->argument('name'));
    $module = $this->laravel['modules']->findOrFail($this->argument('module'));
    $type = Str::studly($this->argument('type'));
    $path = $this->laravel['modules']->getModulePath(app('modules')->findOrFail($module ? : app('modules')->getUsedNow())->getStudlyName());
    $requestPath = str_replace('/', '\\', GenerateConfigReader::read('request')->getPath());
    $path = str_replace('/', '\\', $path . $requestPath . '\\' . $name . '\\' . $name . $type . 'Request.php');
    if ( !$this->laravel['files']->isDirectory($dir = dirname(str_replace('\\', '/', $path)))) {
      $this->laravel['files']->makeDirectory($dir, 0777, true);
    }
    
    $module_namespace = config('modules.namespace') . '\\' . $module;
    $contents = (new Stub('/request.stub', [
      'NAMESPACE' => $module_namespace . '\\' . $requestPath . '\\' . $name,
      'MODULE' => $module_namespace,
      'NAME' => $this->argument('name'),
      'TYPE' => $type,
      'LOWER_TYPE' => strtolower($type),
    ]))->render();
    try {
      $overwriteFile = $this->hasOption('force') ? $this->option('force') : false;
      (new FileGenerator($path, $contents))->withFileOverwrite($overwriteFile)->generate();
      
      $this->info("Created : {$path}");
    } catch (FileAlreadyExistException $e) {
      $this->error("Dosya : {$path} zaten bulunuyor.");
    }
  }
}
