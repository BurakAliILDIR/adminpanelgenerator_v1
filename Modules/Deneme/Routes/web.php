<?php

use Illuminate\Support\Facades\Route;

Route::prefix('deneme')->group(function () {
    Route::get('/', 'DenemeController@index')->name('deneme.index');
    Route::get('/create', 'DenemeController@create')->name('deneme.create');
    Route::get('/{id}', 'DenemeController@show')->name('deneme.show');
    Route::get('/{id}/edit', 'DenemeController@edit')->name('deneme.edit');
    Route::put('/{id}/duzenle', 'DenemeController@update')->name('deneme.update');
    Route::post('/', 'DenemeController@store')->name('deneme.store');
    Route::delete('/sil/{id}', 'DenemeController@destroy')->name('deneme.destroy');
    Route::post('/imageUpload/{id}/{collection}', 'DenemeController@imageUpload')->name('deneme.imageUpload');
});

Route::prefix('post')->group(function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::get('/{id}', 'PostController@show')->name('post.show');
    Route::get('/{id}/edit', 'PostController@edit')->name('post.edit');
    Route::put('/{id}/duzenle', 'PostController@update')->name('post.update');
    Route::post('/', 'PostController@store')->name('post.store');
    Route::delete('/sil/{id}', 'PostController@destroy')->name('post.destroy');
});
