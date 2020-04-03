<?php

use Illuminate\Support\Facades\Route;

Route::prefix('deneme2')->group(function () {
  Route::get('/', 'Deneme2Controller@index')->middleware('permission:Deneme2.index')->name('deneme2.index');
  Route::get('/ekle', 'Deneme2Controller@create')->middleware('permission:Deneme2.create')->name('deneme2.create');
  Route::post('/', 'Deneme2Controller@store')->middleware('permission:Deneme2.create')->name('deneme2.store');
  Route::get('/{id}', 'Deneme2Controller@show')->middleware('permission:Deneme2.detail')->name('deneme2.show');
  Route::get('/{id}/duzenle', 'Deneme2Controller@edit')->middleware('permission:Deneme2.update')->name('deneme2.edit');
  Route::put('/{id}', 'Deneme2Controller@update')->middleware('permission:Deneme2.update')->name('deneme2.update');
  Route::delete('/', 'Deneme2Controller@destroy')->middleware('permission:Deneme2.delete')->name('deneme2.destroy');
});
