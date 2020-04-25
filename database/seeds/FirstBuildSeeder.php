<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FirstBuildSeeder extends Seeder
{
  public function run()
  {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    
    $my_user = \App\Models\User::create([
      'name' => 'Burak Ali',
      'surname' => 'ILDIR',
      'email' => 'TheNobleBrain@gmail.com',
      'password' => \Illuminate\Support\Facades\Hash::make('123123123'),
      'confirm' => 1,
      'email_verified_at' => now(),
    ]);
    
    // TODO : Config dosyası ayarları
    config(['my-config.super_admin_id' => Crypt::encryptString($my_user->id)]);
    config(['my-config.error_logviewer_middleware' => Crypt::encryptString('verified,auth,permission:Application.Settings')]);
    config(['my-config.danger_mail' => Crypt::encryptString('burakaliildir@gmail.com')]);
    $text = '<?php return ' . var_export(config('my-config'), true) . ';';
    file_put_contents(config_path('my-config.php'), $text);
    
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    
    $role = Role::create(['name' => 'super-admin']);
    \App\Models\User::findOrFail($my_user->id)->assignRole($role);
    $my_user->saveOrFail();
    
    $permissions = ['index', 'detail', 'create', 'update', 'delete'];
    $modules = ['User', 'Role', 'Permission'];
    foreach ($modules as $module) {
      foreach ($permissions as $permission) {
        if ($module === 'Permission' && ($permission === 'create' || $permission === 'delete')) continue;
        (new Permission)->create(['name' => $module . '.' . $permission]);
      }
      if ($module === 'User') {
        (new Permission)->create(['name' => 'User.imageUpload']);
        (new Permission)->create(['name' => 'User.imageDelete']);
      }
    }
    (new Permission)->create(['name' => 'Logs.index']);
  }
}
