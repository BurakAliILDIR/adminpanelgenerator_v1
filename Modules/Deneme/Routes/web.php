<?php

use Illuminate\Support\Facades\Route;

Route::prefix('deneme')->middleware(['auth', 'verified'])->group(function () {
  Route::get('/', 'DenemeController@index')->middleware('permission:Deneme.index')->name('Deneme.index');
  Route::get('/ekle', 'DenemeController@create')->middleware('permission:Deneme.create')->name('Deneme.create');
  Route::post('/', 'DenemeController@store')->middleware('permission:Deneme.create')->name('Deneme.store');
  Route::get('/{id}', 'DenemeController@show')->middleware('permission:Deneme.detail')->name('Deneme.show');
  Route::get('/{id}/duzenle', 'DenemeController@edit')->middleware('permission:Deneme.update')->name('Deneme.edit');
  Route::put('/{id}', 'DenemeController@update')->middleware('permission:Deneme.update')->name('Deneme.update');
  Route::delete('/', 'DenemeController@destroy')->middleware('permission:Deneme.delete')->name('Deneme.destroy');
});
