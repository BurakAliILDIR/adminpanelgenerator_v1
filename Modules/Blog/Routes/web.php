<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:super-admin']], function () {
  Route::get('/', 'BlogController@index')->middleware('Blog.index')->name('blog.index');
  Route::get('/ekle', 'BlogController@create')->middleware('Blog.create')->name('blog.create');
  Route::get('/{id}', 'BlogController@show')->middleware('Blog.show')->name('blog.show');
  Route::get('/{id}/duzenle', 'BlogController@edit')->middleware('Blog.update')->name('blog.edit');
  Route::put('/{id}', 'BlogController@update')->middleware('Blog.update')->name('blog.update');
  Route::post('/', 'BlogController@store')->middleware('Blog.create')->name('blog.create');
  Route::delete('/', 'BlogController@destroy')->middleware('Blog.delete')->name('blog.destroy');
})->prefix('blog');
