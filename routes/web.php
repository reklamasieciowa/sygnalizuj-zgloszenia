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
Route::get('/zgloszenia/kosz', 'EntryController@trashed')->name('entries.trashed');
Route::delete('/zgloszenia/kosz/', 'EntryController@emptyTrash')->name('entries.trashed.empty');

Route::get('/zgloszenia/dodaj', 'EntryController@create')->name('entry.create');
Route::post('/zgloszenia/dodaj', 'EntryController@store')->name('entry.store');

Route::get('/zgloszenia/edytuj/{entry}', 'EntryController@edit')->name('entry.edit');
Route::post('/zgloszenia/edytuj/{entry}', 'EntryController@update')->name('entry.update');

Route::get('/zgloszenia/usun/{entry}', 'EntryController@destroy')->name('entry.delete');

Route::get('/zgloszenia/przywroc/{id}', 'EntryController@restore')->name('entry.restore');

Route::get('/zgloszenia/status/{entry}', 'EntryController@changeStatus')->name('entry.changestatus');

Route::get('/zgloszenia/{entry}', 'EntryController@show')->name('entry.show');

Route::get('/zgloszenia/', 'EntryController@index')->name('entries');


Route::get('/tematy', 'SubjectController@index')->name('subjects');
Route::post('/tematy', 'SubjectController@store')->name('subjects.store');

Route::get('/tematy/edytuj/{subject}', 'SubjectController@edit')->name('subjects.edit');
Route::post('/tematy/edytuj/{subject}', 'SubjectController@update')->name('subjects.update');

Route::get('/tematy/usun/{subject}', 'SubjectController@destroy')->name('subjects.destroy');



Route::get('/tematy/{subject}', 'SubjectController@entries')->name('subjects.entries');