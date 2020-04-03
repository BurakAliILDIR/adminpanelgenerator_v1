<?php

use Illuminate\Support\Facades\Route;

Route::prefix('deneme1')->group(function () {
  Route::get('/', 'Deneme1Controller@index')->middleware('permission:Deneme1.index')->name('deneme1.index');
  Route::get('/ekle', 'Deneme1Controller@create')->middleware('permission:Deneme1.create')->name('deneme1.create');
  Route::post('/', 'Deneme1Controller@store')->middleware('permission:Deneme1.create')->name('deneme1.store');
  Route::get('/{id}', 'Deneme1Controller@show')->middleware('permission:Deneme1.detail')->name('deneme1.show');
  Route::get('/{id}/duzenle', 'Deneme1Controller@edit')->middleware('permission:Deneme1.update')->name('deneme1.edit');
  Route::put('/{id}', 'Deneme1Controller@update')->middleware('permission:Deneme1.update')->name('deneme1.update');
  Route::delete('/', 'Deneme1Controller@destroy')->middleware('permission:Deneme1.delete')->name('deneme1.destroy');
});
