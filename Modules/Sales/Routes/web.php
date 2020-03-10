<?php

use Illuminate\Support\Facades\Route;

Route::prefix('satis')->group(function () {
    Route::get('/', 'SalesController@index')->name('sales.index');
    Route::get('/detay/{id}', 'SalesController@show')->name('sales.show');
    //Route::get('/ekle', 'SalesController@create')->name('sales.create');
    //Route::post('/ekle', 'SalesController@store')->name('sales.store');
    //Route::get('/{id}/duzenle', 'SalesController@edit')->name('sales.edit');
    //Route::put('/{id}', 'SalesController@update')->name('sales.update');
    //Route::delete('/sil/{id}', 'SalesController@destroy')->name('sales.destroy');
});
