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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/export', 'ExportController@export')->name('export');

Route::resource('sites', 'SitesController');

Route::prefix('airtable')->group(function () {
    Route::get('{site_id}', 'AirtableController@show')->name('view-airtable');
});
