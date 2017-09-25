<?php

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/colloquia', 'ColloquiaController@index')->name('colloquia.index');

Route::get('/home', 'HomeController@index')->name('home');


/*
 * Authenticated routes.
 */
Route::middleware('auth')->group(function() {
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/users/edit/{user}', 'UsersController@edit')->name('users.edit');
    Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

    Route::get('/colloquia/create', 'ColloquiaController@create')->name('colloquia.create');
    Route::post('/colloquia', 'ColloquiaController@store')->name('colloquia.store');
});
