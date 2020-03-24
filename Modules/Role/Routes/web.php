<?php

use Illuminate\Support\Facades\Route;

Route::prefix('role')->group(function () {
    Route::get('/', 'RoleController@index')->name('role.index');
    Route::get('/ekle', 'RoleController@create')->name('role.create');
    Route::get('/{id}', 'RoleController@show')->name('role.show');
    Route::get('/{id}/duzenle', 'RoleController@edit')->name('role.edit');
    Route::put('/{id}', 'RoleController@update')->name('role.update');
    Route::post('/', 'RoleController@store')->name('role.store');
    Route::delete('/', 'RoleController@destroy')->name('role.destroy');
});
