<?php

use Illuminate\Support\Facades\Route;

Route::prefix('person')->group(function () {
  Route::get('/', 'PersonController@index')->middleware('permission:Person.index')->name('person.index');
  Route::get('/ekle', 'PersonController@create')->middleware('permission:Person.create')->name('person.create');
  Route::post('/', 'PersonController@store')->middleware('permission:Person.create')->name('person.store');
  Route::get('/{id}', 'PersonController@show')->middleware('permission:Person.detail')->name('person.show');
  Route::get('/{id}/duzenle', 'PersonController@edit')->middleware('permission:Person.update')->name('person.edit');
  Route::put('/{id}', 'PersonController@update')->middleware('permission:Person.update')->name('person.update');
  Route::delete('/', 'PersonController@destroy')->middleware('permission:Person.delete')->name('person.destroy');
});
