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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//admin
//Route::resource('entries', 'EntryController'); 
//https://laravel.com/docs/5.8/controllers#resource-controllers

Route::post('/zgloszenia/przywroc/{entry}', 'EntryController@restore')->name('entry.restore');
Route::post('/zgloszenia/status/{entry}', 'EntryController@changeStatus')->name('entry.changestatus');

Route::get('/zgloszenia/kosz', 'EntryController@trashed')->name('entries.trashed');
Route::delete('/zgloszenia/kosz/', 'EntryController@emptyTrash')->name('entries.trashed.empty');

Route::get('/zgloszenia/edytuj/{entry}', 'EntryController@edit')->name('entry.edit');
Route::post('/zgloszenia/edytuj/{entry}', 'EntryController@update')->name('entry.update');

Route::get('/zgloszenia/dodaj', 'EntryController@create')->name('entry.create');
Route::post('/zgloszenia/dodaj', 'EntryController@store')->name('entry.store');

Route::delete('/zgloszenia/{entry}', 'EntryController@destroy')->name('entry.delete');
Route::get('/zgloszenia/{entry}', 'EntryController@show')->name('entry.show');
Route::get('/zgloszenia/', 'EntryController@index')->name('entries');

Route::get('/tematy', 'SubjectController@index')->name('subjects');
Route::post('/tematy', 'SubjectController@store')->name('subjects.store');

Route::get('/tematy/edytuj/{subject}', 'SubjectController@edit')->name('subjects.edit');
Route::post('/tematy/edytuj/{subject}', 'SubjectController@update')->name('subjects.update');

Route::delete('/tematy/usun/{subject}', 'SubjectController@destroy')->name('subjects.destroy');

Route::get('/tematy/{subject}', 'SubjectController@entries')->name('subjects.entries');


Route::get('/statusy', 'StatusController@index')->name('statuses');

Route::post('/statusy', 'StatusController@store')->name('statuses.store');

Route::get('/statusy/edytuj/{status}', 'StatusController@edit')->name('statuses.edit');
Route::post('/statusy/edytuj/{status}', 'StatusController@update')->name('statuses.update');

Route::delete('/statusy/usun/{status}', 'StatusController@destroy')->name('statuses.destroy');

Route::get('/statusy/{status}', 'StatusController@entries')->name('statuses.entries');

