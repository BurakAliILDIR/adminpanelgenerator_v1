<?php

use Illuminate\Support\Facades\Route;

Route::prefix('deneme')->middleware(['auth', 'verified'])->group(function () {
  Route::get('/', 'DenemeController@index')->middleware('permission:Deneme.index')->name('deneme.index');
  Route::get('/ekle', 'DenemeController@create')->middleware('permission:Deneme.create')->name('deneme.create');
  Route::post('/', 'DenemeController@store')->middleware('permission:Deneme.create')->name('deneme.store');
  Route::get('/{id}', 'DenemeController@show')->middleware('permission:Deneme.detail')->name('deneme.show');
  Route::get('/{id}/duzenle', 'DenemeController@edit')->middleware('permission:Deneme.update')->name('deneme.edit');
  Route::put('/{id}', 'DenemeController@update')->middleware('permission:Deneme.update')->name('deneme.update');
  Route::delete('/', 'DenemeController@destroy')->middleware('permission:Deneme.delete')->name('deneme.destroy');
});
