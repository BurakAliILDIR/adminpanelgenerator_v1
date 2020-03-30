<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FirstBuildSeeder extends Seeder
{
  public function run()
  {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $user = new \App\Models\User();
    $user->name = 'Burak Ali';
    $user->surname = 'ILDIR';
    $user->email = 'burakaliildir@gmail.com';
    $user->password = \Illuminate\Support\Facades\Hash::make('123123123');
    $user->confirm = 1;
    $user->saveOrFail();
    
    $role = Role::create(['name' => 'super-admin']);
    \App\Models\User::findOrFail($user->id)->assignRole($role);
    $user->email_verified_at = now();
    $user->saveOrFail();
    
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
  }
}
