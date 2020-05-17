<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/anasayfa', 'DefaultControllers\HomeController@index')->middleware(['verified', 'auth'])->name('home');
Route::redirect('/', 'anasayfa');

Route::prefix('application-build')->middleware(['verified', 'auth', 'application_settings_guard', 'permission:Application.Settings'])->group(function () {
  Route::resource('modules', 'Application\ModuleController');
  Route::get('migrate-refresh/{module_name?}', 'Application\ModuleController@migrate_refresh')->name('modules.migrate_refresh');
  // Module içindeki alanların route ları. 
  Route::get('fields/{module}/{related?}', 'Application\FieldController@create')->name('fields.create');
  Route::post('fields/{module}/{related?}', 'Application\FieldController@store')->name('fields.store');
  Route::get('fields/{module}/{key}/detay', 'Application\FieldController@show')->name('fields.show');
  Route::get('fields/{module}/{key}/duzenle', 'Application\FieldController@edit')->name('fields.edit');
  Route::put('fields/{module}/{key}', 'Application\FieldController@update')->name('fields.update');
  Route::delete('fields/{module}/{key}', 'Application\FieldController@destroy')->name('fields.destroy');
  Route::post('fields', 'Application\FieldController@getFields')->name('fields.getFields');
});

Route::prefix('image')->middleware(['verified', 'auth'])->group(function () {
  Route::post('/upload/{id}/{collection}/{path}', 'DefaultControllers\ImageController@imageUpload')->name('imageUpload');
  Route::delete('delete/{class_name}', 'DefaultControllers\ImageController@imageDelete')->name('imageDelete');
});

Route::prefix('profil')->middleware(['verified', 'auth'])->group(function () {
  Route::get('/', 'DefaultControllers\ProfileController@index')->name('profile.index');
  Route::get('/duzenle', 'DefaultControllers\ProfileController@edit')->name('profile.edit');
  Route::put('/', 'DefaultControllers\ProfileController@update')->name('profile.update');
  Route::post('/image-upload/{collection}', 'DefaultControllers\ProfileController@imageUpload')->name('profileImageUpload');
  Route::delete('image-delete', 'DefaultControllers\ProfileController@imageDelete')->name('profileImageDelete');
});

Route::prefix('roller')->middleware(['verified', 'auth'])->group(function () {
  Route::get('/', 'DefaultControllers\RoleController@index')->middleware('permission:Role.index')->name('role.index');
  Route::get('/ekle', 'DefaultControllers\RoleController@create')->middleware('permission:Role.create')->name('role.create');
  Route::post('/', 'DefaultControllers\RoleController@store')->middleware('permission:Role.create')->name('role.store');
  Route::get('/{id}', 'DefaultControllers\RoleController@show')->middleware('permission:Role.detail')->name('role.show');
  Route::get('/{id}/duzenle', 'DefaultControllers\RoleController@edit')->middleware('permission:Role.update')->name('role.edit');
  Route::put('/{id}', 'DefaultControllers\RoleController@update')->middleware('permission:Role.update')->name('role.update');
  Route::delete('/', 'DefaultControllers\RoleController@destroy')->middleware('permission:Role.delete')->name('role.destroy');
});

Route::prefix('kullanicilar')->middleware(['verified', 'auth'])->group(function () {
	Route::get('/', 'DefaultControllers\UserController@index')->middleware('permission:User.index')->name('user.index');
	Route::get('/ekle', 'DefaultControllers\UserController@create')->middleware('permission:User.create')->name('user.create');
	Route::post('/', 'DefaultControllers\UserController@store')->middleware('permission:User.create')->name('user.store');
	Route::get('/{id}', 'DefaultControllers\UserController@show')->middleware('permission:User.detail')->name('user.show');
	Route::get('/{id}/duzenle', 'DefaultControllers\UserController@edit')->middleware('permission:User.update')->name('user.edit');
	Route::put('/{id}', 'DefaultControllers\UserController@update')->middleware('permission:User.update')->name('user.update');
	Route::delete('/', 'DefaultControllers\UserController@destroy')->middleware('permission:User.delete')->name('user.destroy');
});

Route::prefix('izinler')->middleware(['verified', 'auth'])->group(function () {
	Route::get('/', 'DefaultControllers\PermissionController@index')->middleware('permission:Permission.index')->name('permission.index');
	Route::get('/{id}', 'DefaultControllers\PermissionController@show')->middleware('permission:Permission.detail')->name('permission.show');
	Route::get('/{id}/duzenle', 'DefaultControllers\PermissionController@edit')->middleware('permission:Permission.update')->name('permission.edit');
	Route::put('/{id}', 'DefaultControllers\PermissionController@update')->middleware('permission:Permission.update')->name('permission.update');
});

Route::prefix('sistem-ayarlar')->middleware(['verified', 'auth'])->group(function () {
	Route::get('/', 'DefaultControllers\SystemSettingsController@index')->middleware('permission:SystemSettings.index')->name('system_settings.index');
	Route::get('/duzenle', 'DefaultControllers\SystemSettingsController@edit')->middleware('permission:SystemSettings.edit')->name('system_settings.edit');
	Route::put('/', 'DefaultControllers\SystemSettingsController@update')->middleware('permission:SystemSettings.edit')->name('system_settings.update');
});


Route::get('/etkinlikler', 'DefaultControllers\LogsController@index')->middleware(['verified', 'auth', 'permission:Logs.index'])->name('Logs.index');

