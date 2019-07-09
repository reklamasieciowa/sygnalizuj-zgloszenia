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

Route::get('/zgloszenia/edytuj/{entry}', 'EntryController@edit')->name('entry.edit');
Route::post('/zgloszenia/edytuj/{entry}', 'EntryController@update')->name('entry.update');

Route::get('/zgloszenia/usun/{entry}', 'EntryController@destroy')->name('entry.delete');

Route::get('/zgloszenia/przywroc/{id}', 'EntryController@restore')->name('entry.restore');

Route::get('/zgloszenia/status/{entry}', 'EntryController@changeStatus')->name('entry.changestatus');

Route::get('/zgloszenia/{entry}', 'EntryController@show')->name('entry.show');

Route::get('/zgloszenia', 'EntryController@index')->name('entries');
