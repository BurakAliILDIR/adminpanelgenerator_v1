<?php

namespace App\Providers;

use App\Models\SystemSettings;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
	public function register()
	{
		//
	}
	
	public function boot()
	{
		View::composer('*', function ($view) {
			$key = config('cache.prefix') . ':system_settings';
			if ( !($system_settings = unserialize(Redis::get($key)))) {
				foreach (SystemSettings::all()->toArray() as $setting) {
					$system_settings[$setting['key']] = $setting['value'];
				}
				Redis::set($key, serialize($system_settings));
			}
			
			$view->with('system_settings', $system_settings);
		});
	}
}
