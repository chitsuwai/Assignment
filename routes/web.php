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

Route::get('/', function () {
    return view('visitors.create');
});
Route::post('/', function () {
    return view('visitors.index');
});
Route::get('/visitors', 'VisitorController@index');
Route::get('/visitors/set_session', 'VisitorController@set_session');
Route::get('/visitors/clear_session', 'VisitorController@clear_session');
Route::get('/visitors/show_data', 'VisitorController@show_data');
// Route::get('/visitors', function () {
//     return view('visitors.create');
// });
Route::resource('visitors','VisitorController');