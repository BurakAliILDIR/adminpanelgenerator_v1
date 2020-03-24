<?php

use Illuminate\Support\Facades\Route;

Route::prefix('article')->group(function () {
    Route::get('/', 'ArticleController@index')->name('article.index');
    Route::get('/ekle', 'ArticleController@create')->name('article.create');
    Route::get('/{id}', 'ArticleController@show')->name('article.show');
    Route::get('/{id}/duzenle', 'ArticleController@edit')->name('article.edit');
    Route::put('/{id}', 'ArticleController@update')->name('article.update');
    Route::post('/', 'ArticleController@store')->name('article.store');
    Route::delete('/', 'ArticleController@destroy')->name('article.destroy');
});
