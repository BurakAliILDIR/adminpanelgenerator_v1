<?php

use App\Models\SystemSettings;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FirstBuildSeeder extends Seeder
{
	public function run()
	{
		Artisan::call('cache:clear');
		Artisan::call('config:cache');
		
		$my_user = User::create([
			'name' => 'Burak Ali',
			'surname' => 'ILDIR',
			'email' => 'TheNobleBrain@gmail.com',
			'password' => Hash::make('123123123'),
			'confirm' => 1,
			'email_verified_at' => now(),
		]);
		
		// TODO : Config dosyası ayarları
		config(['my-config.super_admin_id' => Crypt::encryptString($my_user->id)]);
		config(['my-config.error_logviewer_middleware' => Crypt::encryptString('verified,auth,permission:Application.Settings')]);
		config(['my-config.danger_mail' => Crypt::encryptString('burakaliildir@gmail.com')]);
		$text = '<?php return ' . var_export(config('my-config'), true) . ';';
		file_put_contents(config_path('my-config.php'), $text);
		
		Artisan::call('config:cache');
		
		$role = Role::create(['name' => 'super-admin']);
		User::findOrFail($my_user->id)->assignRole($role);
		$my_user->saveOrFail();
		
		$permissions = ['index', 'detail', 'create', 'update', 'delete', 'imageUpload', 'imageDelete'];
		$modules = array_merge(array_keys(Module::all()), ['User', 'Role', 'Permission']);
		foreach ($modules as $module) {
			foreach ($permissions as $permission) {
				if ($module === 'Permission' && ($permission === 'create' || $permission === 'delete' || $permission === 'imageUpload' || $permission === 'imageDelete')) continue;
				if ($module === 'Role' && ($permission === 'imageUpload' || $permission === 'imageDelete')) continue;
				
				(new Permission)->create(['name' => "$module.$permission"]);
			}
		}
		(new Permission)->create(['name' => 'Logs.index']);
		(new Permission)->create(['name' => 'SystemSettings.index']);
		(new Permission)->create(['name' => 'SystemSettings.update']);
		
		// TODO: Sistem ayarlarını oluşturma:
		$system_settings = [
			'name' => config('app.name'),
			'description' => config('app.description'),
			'email' => 'w',
			'phone' => 'w',
			'fax' => 'w',
			'address' => 'w',
			'about' => 'w',
			'isLogo' => true,
		];
		foreach ($system_settings as $key => $value) {
			SystemSettings::create(['key' => $key, 'value' => $value]);
		}
		
	}
}
