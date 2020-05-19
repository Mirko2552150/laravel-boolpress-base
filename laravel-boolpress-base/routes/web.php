<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'PostController@index')->name('posts.index');

Route::get('/', 'PostController@index')->name('posts.index'); // cerco il controller e il nome della funzione, il name e' la index dei post, PARLANTE
