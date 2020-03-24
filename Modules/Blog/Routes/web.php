<?php

use Illuminate\Support\Facades\Route;

Route::prefix('blog')->group(function () {
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::get('/ekle', 'BlogController@create')->name('blog.create');
    Route::get('/{id}', 'BlogController@show')->name('blog.show');
    Route::get('/{id}/duzenle', 'BlogController@edit')->name('blog.edit');
    Route::put('/{id}', 'BlogController@update')->name('blog.update');
    Route::post('/', 'BlogController@store')->name('blog.store');
    Route::delete('/', 'BlogController@destroy')->name('blog.destroy');
});
