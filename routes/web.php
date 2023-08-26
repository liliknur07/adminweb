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
  return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::name('member.')->middleware(['auth', 'can:admin'])->prefix('member')->group(function () {
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/users', 'MemberController@index')->name('users');
  Route::post('/users', 'MemberController@index');
  Route::get('/abuses', 'MemberController@abuses')->name('abuses');
  Route::post('/abuses', 'MemberController@abuses');
  Route::get('/socializations', 'MemberController@socializations')->name('socializations');
  Route::post('/socializations', 'MemberController@socializations');
  Route::get('/rehabilitations', 'MemberController@rehabilitations')->name('rehabilitations');
  Route::post('/rehabilitations', 'MemberController@rehabilitations');
  Route::get('/consultations', 'MemberController@consultations')->name('consultations');
  Route::post('/consultations', 'MemberController@consultations');
});
