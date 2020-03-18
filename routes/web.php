<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/imageUpload/{id}/{collection}/{path}', 'ImageController@imageUpload')->name('imageUpload');
Route::delete('deleteImage', 'ImageController@deleteImage')->name('deleteImage');
