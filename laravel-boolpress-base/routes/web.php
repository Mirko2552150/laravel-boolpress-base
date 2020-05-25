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

Route::resource('posts', 'PostController'); // creiamo piu rotte collegate alle funzioni(metodi) del controller, il primo arg si riferice all URI

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

 Route::prefix('admin')
 ->namespace('Admin')
 ->name('admin.')
 ->middleware('auth')

 ->group(function () {
   Route::resource('users', 'UserController');
 });
