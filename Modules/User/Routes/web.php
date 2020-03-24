<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/ekle', 'UserController@create')->name('user.create');
    Route::get('/{id}', 'UserController@show')->name('user.show');
    Route::get('/{id}/duzenle', 'UserController@edit')->name('user.edit');
    Route::put('/{id}', 'UserController@update')->name('user.update');
    Route::post('/', 'UserController@store')->name('user.store');
    Route::delete('/', 'UserController@destroy')->name('user.destroy');
});
