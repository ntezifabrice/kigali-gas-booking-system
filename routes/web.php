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

Route::get('/', 'HomepageController@index')->name('welcome');
Route::get('/cylinders', 'HomepageController@cylinders');
Route::get('/agents', 'HomepageController@agents');
Route::get('/search', 'HomepageController@searchFormData');
Route::get('/agents/{id}', 'HomepageController@singleAgent');
Route::get('/booking/{id}', 'BookingController@create')->name('booking');
Route::post('/booking/{id}', 'BookingController@store');
Route::get('/confirmation/{transaction_id}', 'BookingController@confirmation')->name('confirmation');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'HomepageController@resetPassword')->name('password.reset');
Route::post('password/reset', 'HomepageController@postResetPassword');

Route::get('/cylinders/{id}', function ($id) {
    return redirect(route('booking', $id), 301);
});
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/profile', 'DashboardController@profile');
    Route::post('/profile', 'DashboardController@postProfile');
    Route::get('/password', 'DashboardController@password');
    Route::post('/password', 'DashboardController@postPassword');
    Route::get('/booking', 'DashboardController@booking');
    Route::get('/booking/{id}', 'DashboardController@singleBooking');
    Route::post('/booking/{id}', 'DashboardController@postSingleBooking');
});
Route::group(['prefix' => 'dashboard/agent'], function () {
    Route::get('/', 'AgentDashboardController@index');
    Route::get('/profile', 'AgentDashboardController@profile');
    Route::post('/profile', 'AgentDashboardController@postProfile');
    Route::get('/password', 'AgentDashboardController@password');
    Route::post('/password', 'AgentDashboardController@postPassword');
    Route::get('/booking', 'AgentDashboardController@booking');
    Route::get('/booking/{id}', 'AgentDashboardController@singleBooking');
    Route::post('/booking/{id}', 'AgentDashboardController@postSingleBooking');
    Route::get('/consumers', 'AgentDashboardController@consumers');
    Route::get('/consumers/{id}', 'AgentDashboardController@singleConsumer');
    Route::get('/cylinders', 'AgentDashboardController@cylinders');
    Route::get('/cylinders/add', 'AgentDashboardController@addCylinder');
    Route::post('/cylinders/add', 'AgentDashboardController@postAddCylinder');
    Route::get('/cylinders/{id}', 'AgentDashboardController@singleCylinder');
    Route::get('/cylinders/{id}/edit', 'AgentDashboardController@editSingleCylinder');
    Route::post('/cylinders/{id}', 'AgentDashboardController@postSingleCylinder');
    Route::delete('/cylinders/{id}', 'AgentDashboardController@deleteSingleCylinder');
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
