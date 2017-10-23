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

/* Routes for the authentication system. */
Auth::routes();

/*
 * Homepage
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/tv', 'HomeController@tv')->name('tv');

/*
 * Colloquia
 */
Route::get('/colloquia/request', 'ColloquiaController@request')->name('colloquia.request');
Route::get('/colloquia/request/{token}/edit', 'ColloquiaController@editRequest')->name('colloquia.request.edit');

/*
 * Secured pages.
 */
Route::middleware('auth')->group(function() {

    /*
     * Colloquia
     */
    Route::get('/colloquia', 'ColloquiaController@index')->name('colloquia.index');
    Route::get('/colloquia/create', 'ColloquiaController@create')->name('colloquia.create');
    Route::post('/colloquia', 'ColloquiaController@store')->name('colloquia.store');
    Route::get('/colloquia/{colloquium}/edit', 'ColloquiaController@edit')->name('colloquia.edit');
    Route::patch('/colloquia/{colloquium}', 'ColloquiaController@update')->name('colloquia.update');
    Route::get('/colloquia/accept/{colloquium}', 'ColloquiaController@accept')->name('colloquia.accept');
    Route::get('/colloquia/decline/{colloquium}', 'ColloquiaController@decline')->name('colloquia.decline');
    Route::get('/colloquia/{colloquium}/edit', 'ColloquiaController@edit')->name('colloquia.edit');
    Route::patch('/colloquia/{colloquium}', 'ColloquiaController@update')->name('colloquia.update');

    /*
     * Users
     */
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

    /*
     * Trainings
     */
    Route::get('/trainings', 'TrainingsController@index')->name('trainings.index');
    Route::get('/trainings/create', 'TrainingsController@create')->name('trainings.create');
    Route::post('/trainings', 'TrainingsController@store')->name('trainings.store');
    Route::patch('/trainings/{training}/subscribe', 'TrainingsController@subscribe')->name('trainings.subscribe');
    Route::patch('/trainings/{training}/unsubscribe', 'TrainingsController@unsubscribe')->name('trainings.unsubscribe');
    Route::get('/trainings/{training}/edit', 'TrainingsController@edit')->name('trainings.edit');
    Route::patch('/trainings/{training}', 'TrainingsController@update')->name('trainings.update');
    Route::delete('/trainings/{training}', 'TrainingsController@destroy')->name('trainings.destroy');
});

// Put route here because of the first parameter.
Route::get('/colloquia/{colloquium}', 'ColloquiaController@show')->name('colloquia.show');
