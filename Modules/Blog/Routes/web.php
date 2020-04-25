<?php

use Illuminate\Support\Facades\Route;

Route::prefix('blog')->middleware(['auth', 'verified'])->group(function () {
  Route::get('/', 'BlogController@index')->middleware('permission:Blog.index')->name('Blog.index');
  Route::get('/ekle', 'BlogController@create')->middleware('permission:Blog.create')->name('Blog.create');
  Route::post('/', 'BlogController@store')->middleware('permission:Blog.create')->name('Blog.store');
  Route::get('/{id}', 'BlogController@show')->middleware('permission:Blog.detail')->name('Blog.show');
  Route::get('/{id}/duzenle', 'BlogController@edit')->middleware('permission:Blog.update')->name('Blog.edit');
  Route::put('/{id}', 'BlogController@update')->middleware('permission:Blog.update')->name('Blog.update');
  Route::delete('/', 'BlogController@destroy')->middleware('permission:Blog.delete')->name('Blog.destroy');
});
