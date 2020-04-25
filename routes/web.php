<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/anasayfa', 'HomeController@index')->middleware(['verified', 'auth'])->name('home');
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
  Route::post('/upload/{id}/{collection}/{path}', 'ImageController@imageUpload')->name('imageUpload');
  Route::delete('delete/{class_name}', 'ImageController@imageDelete')->name('imageDelete');
});

Route::prefix('profil')->middleware(['verified', 'auth'])->group(function () {
  Route::get('/', 'ProfileController@index')->name('profile.index');
  Route::get('/duzenle', 'ProfileController@edit')->name('profile.edit');
  Route::put('/', 'ProfileController@update')->name('profile.update');
  Route::post('/image-upload/{collection}', 'ProfileController@imageUpload')->name('profileImageUpload');
  Route::delete('image-delete', 'ProfileController@imageDelete')->name('profileImageDelete');
});

Route::prefix('roller')->middleware(['verified', 'auth'])->group(function () {
  Route::get('/', 'RoleController@index')->middleware('permission:Role.index')->name('role.index');
  Route::get('/ekle', 'RoleController@create')->middleware('permission:Role.create')->name('role.create');
  Route::post('/', 'RoleController@store')->middleware('permission:Role.create')->name('role.store');
  Route::get('/{id}', 'RoleController@show')->middleware('permission:Role.detail')->name('role.show');
  Route::get('/{id}/duzenle', 'RoleController@edit')->middleware('permission:Role.update')->name('role.edit');
  Route::put('/{id}', 'RoleController@update')->middleware('permission:Role.update')->name('role.update');
  Route::delete('/', 'RoleController@destroy')->middleware('permission:Role.delete')->name('role.destroy');
});

Route::prefix('kullanicilar')->middleware(['verified', 'auth'])->group(function () {
  Route::get('/', 'UserController@index')->middleware('permission:User.index')->name('user.index');
  Route::get('/ekle', 'UserController@create')->middleware('permission:User.create')->name('user.create');
  Route::post('/', 'UserController@store')->middleware('permission:User.create')->name('user.store');
  Route::get('/{id}', 'UserController@show')->middleware('permission:User.detail')->name('user.show');
  Route::get('/{id}/duzenle', 'UserController@edit')->middleware('permission:User.update')->name('user.edit');
  Route::put('/{id}', 'UserController@update')->middleware('permission:User.update')->name('user.update');
  Route::delete('/', 'UserController@destroy')->middleware('permission:User.delete')->name('user.destroy');
});

Route::prefix('izinler')->middleware(['verified', 'auth'])->group(function () {
  Route::get('/', 'PermissionController@index')->middleware('permission:Permission.index')->name('permission.index');
  Route::get('/{id}', 'PermissionController@show')->middleware('permission:Permission.detail')->name('permission.show');
  Route::get('/{id}/duzenle', 'PermissionController@edit')->middleware('permission:Permission.update')->name('permission.edit');
  Route::put('/{id}', 'PermissionController@update')->middleware('permission:Permission.update')->name('permission.update');
});

Route::get('/etkinlikler', 'LogsController@index')->middleware(['verified', 'auth', 'permission:Logs.index'])->name('Logs.index');

