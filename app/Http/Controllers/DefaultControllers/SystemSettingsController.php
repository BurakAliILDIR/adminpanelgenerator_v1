<?php

namespace App\Http\Controllers\DefaultControllers;

use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\ImageManagerStatic as Image;

class SystemSettingsController extends Controller
{
	public function index()
	{
		return view('admin.system_settings.index');
	}
	
	public function edit()
	{
		return view('admin.system_settings.edit');
	}
	
	public function update(Request $request)
	{
		$settings = $request->except('_token', '_method', 'isLogo');
		foreach ($settings as $key => $value) {
			SystemSettings::find($key)->update(['value' => $value]);
		}
		SystemSettings::find('isLogo')->update(['value' => $request->isLogo ?? 0]);
		
		Image::configure(['driver' => 'imagick']);
		if ($request->hasFile('favicon'))
			Image::make($request->favicon)->resize(24, 24)->save('favicon.ico', 100);
		if ($request->hasFile('logo'))
			Image::make($request->logo)->resize(120, 60)->save('logo.png', 100);
		
		Artisan::call('cache:clear');
		session()->flash('info', 'Sistem bilgileri başarıyla güncellendi.');
		return redirect()->back();
	}
}
