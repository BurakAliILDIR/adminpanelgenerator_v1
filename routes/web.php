<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  if (Auth::id())
    return redirect()->route('user.index');
  return redirect()->route('login');
});

Auth::routes(['verify' => true]);

Route::prefix('application')->middleware(['verified', 'permission:Application.Settings'])->group(function () {
  Route::resource('modules', 'Application\ModuleController');
  Route::get('loglar', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
  // Module içindeki alanların route ları. 
  Route::get('fields/{module}/{related?}', 'Application\FieldController@create')->name('fields.create');
  Route::post('fields/{module}/{related?}', 'Application\FieldController@store')->name('fields.store');
  Route::get('fields/{module}/{key}/detay', 'Application\FieldController@show')->name('fields.show');
  Route::get('fields/{module}/{key}/duzenle', 'Application\FieldController@edit')->name('fields.edit');
  Route::put('fields/{module}/{key}', 'Application\FieldController@update')->name('fields.update');
  Route::delete('fields/{module}/{key}', 'Application\FieldController@destroy')->name('fields.destroy');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('image')->middleware(['verified'])->group(function () {
  Route::post('/upload/{id}/{collection}/{path}', 'ImageController@imageUpload')->name('imageUpload');
  Route::delete('delete/{class_name}', 'ImageController@imageDelete')->name('imageDelete');
});

Route::prefix('profil')->middleware(['verified'])->group(function () {
  Route::get('/', 'ProfileController@index')->name('profile.index');
  Route::get('/duzenle', 'ProfileController@edit')->name('profile.edit');
  Route::put('/', 'ProfileController@update')->name('profile.update');
  Route::post('/image-upload/{collection}', 'ProfileController@imageUpload')->name('profileImageUpload');
  Route::delete('image-delete', 'ProfileController@imageDelete')->name('profileImageDelete');
});

Route::prefix('roller')->middleware(['verified'])->group(function () {
  Route::get('/', 'RoleController@index')->middleware('permission:Role.index')->name('role.index');
  Route::get('/ekle', 'RoleController@create')->middleware('permission:Role.create')->name('role.create');
  Route::post('/', 'RoleController@store')->middleware('permission:Role.create')->name('role.store');
  Route::get('/{id}', 'RoleController@show')->middleware('permission:Role.detail')->name('role.show');
  Route::get('/{id}/duzenle', 'RoleController@edit')->middleware('permission:Role.update')->name('role.edit');
  Route::put('/{id}', 'RoleController@update')->middleware('permission:Role.update')->name('role.update');
  Route::delete('/', 'RoleController@destroy')->middleware('permission:Role.delete')->name('role.destroy');
});

Route::prefix('kullanicilar')->middleware(['verified'])->group(function () {
  Route::get('/', 'UserController@index')->middleware('permission:User.index')->name('user.index');
  Route::get('/ekle', 'UserController@create')->middleware('permission:User.create')->name('user.create');
  Route::post('/', 'UserController@store')->middleware('permission:User.create')->name('user.store');
  Route::get('/{id}', 'UserController@show')->middleware('permission:User.detail')->name('user.show');
  Route::get('/{id}/duzenle', 'UserController@edit')->middleware('permission:User.update')->name('user.edit');
  Route::put('/{id}', 'UserController@update')->middleware('permission:User.update')->name('user.update');
  Route::delete('/', 'UserController@destroy')->middleware('permission:User.delete')->name('user.destroy');
});

Route::prefix('izinler')->middleware(['verified'])->group(function () {
  Route::get('/', 'PermissionController@index')->middleware('permission:Permission.index')->name('permission.index');
  Route::get('/{id}', 'PermissionController@show')->middleware('permission:Permission.detail')->name('permission.show');
  Route::get('/{id}/duzenle', 'PermissionController@edit')->middleware('permission:Permission.update')->name('permission.edit');
  Route::put('/{id}', 'PermissionController@update')->middleware('permission:Permission.update')->name('permission.update');
});

