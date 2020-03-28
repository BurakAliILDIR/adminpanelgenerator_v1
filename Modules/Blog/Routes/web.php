<?php

use Illuminate\Support\Facades\Route;

Route::prefix('blog')->group(function () {
  Route::get('/', 'BlogController@index')->middleware('permission:Blog.index')->name('blog.index');
  Route::get('/ekle', 'BlogController@create')->middleware('permission:Blog.create')->name('blog.create');
  Route::get('/{id}', 'BlogController@show')->middleware('permission:Blog.detail')->name('blog.show');
  Route::get('/{id}/duzenle', 'BlogController@edit')->middleware('permission:Blog.update')->name('blog.edit');
  Route::put('/{id}', 'BlogController@update')->middleware('permission:Blog.update')->name('blog.update');
  Route::post('/', 'BlogController@store')->middleware('permission:Blog.create')->name('blog.store');
  Route::delete('/', 'BlogController@destroy')->middleware('permission:Blog.delete')->name('blog.destroy');
});
