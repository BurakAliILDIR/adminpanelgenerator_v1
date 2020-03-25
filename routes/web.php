<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::post('/imageUpload/{id}/{collection}/{path}', 'ImageController@imageUpload')->name('imageUpload');
Route::delete('deleteImage', 'ImageController@deleteImage')->name('deleteImage');

Route::prefix('roller')->group(function () {
  Route::get('/', 'RoleController@index')->name('role.index');
  Route::get('/ekle', 'RoleController@create')->name('role.create');
  Route::get('/{id}', 'RoleController@show')->name('role.show');
  Route::get('/{id}/duzenle', 'RoleController@edit')->name('role.edit');
  Route::put('/{id}', 'RoleController@update')->name('role.update');
  Route::post('/', 'RoleController@store')->name('role.store');
  Route::delete('/', 'RoleController@destroy')->name('role.destroy');
});
Route::prefix('kullanicilar')->group(function () {
  Route::get('/', 'UserController@index')->name('user.index');
  Route::get('/ekle', 'UserController@create')->name('user.create');
  Route::get('/{id}', 'UserController@show')->name('user.show');
  Route::get('/{id}/duzenle', 'UserController@edit')->name('user.edit');
  Route::put('/{id}', 'UserController@update')->name('user.update');
  Route::post('/', 'UserController@store')->name('user.store');
  Route::delete('/', 'UserController@destroy')->name('user.destroy');
});

Route::prefix('izinler')->group(function () {
  Route::get('/', 'PermissionController@index')->name('permission.index');
  Route::get('/ekle', 'PermissionController@create')->name('permission.create');
  Route::get('/{id}', 'PermissionController@show')->name('permission.show');
  Route::get('/{id}/duzenle', 'PermissionController@edit')->name('permission.edit');
  Route::put('/{id}', 'PermissionController@update')->name('permission.update');
  Route::post('/', 'PermissionController@store')->name('permission.store');
  Route::delete('/', 'PermissionController@destroy')->name('permission.destroy');
});
