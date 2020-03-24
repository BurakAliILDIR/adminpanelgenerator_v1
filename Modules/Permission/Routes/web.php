<?php

use Illuminate\Support\Facades\Route;

Route::prefix('permission')->group(function () {
    Route::get('/', 'PermissionController@index')->name('permission.index');
    Route::get('/ekle', 'PermissionController@create')->name('permission.create');
    Route::get('/{id}', 'PermissionController@show')->name('permission.show');
    Route::get('/{id}/duzenle', 'PermissionController@edit')->name('permission.edit');
    Route::put('/{id}', 'PermissionController@update')->name('permission.update');
    Route::post('/', 'PermissionController@store')->name('permission.store');
    Route::delete('/', 'PermissionController@destroy')->name('permission.destroy');
});
