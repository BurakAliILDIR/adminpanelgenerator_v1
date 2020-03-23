<?php

use Illuminate\Support\Facades\Route;

Route::prefix('yeni')->group(function () {
    Route::get('/', 'YeniController@index')->name('yeni.index');
    Route::get('/ekle', 'YeniController@create')->name('yeni.create');
    Route::get('/{id}', 'YeniController@show')->name('yeni.show');
    Route::get('/{id}/duzenle', 'YeniController@edit')->name('yeni.edit');
    Route::put('/{id}', 'YeniController@update')->name('yeni.update');
    Route::post('/', 'YeniController@store')->name('yeni.store');
    Route::delete('/', 'YeniController@destroy')->name('yeni.destroy');
});
