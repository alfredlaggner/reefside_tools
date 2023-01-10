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

Route::get('sendSMS', [App\Http\Controllers\TwilioSMSController::class, 'index']);
Route::get('getSMS', [App\Http\Controllers\TwilioSMSController::class, 'receive_messages']);

Route::post('/sms', function() {
    $request = request();
    $from = $request->input('From');
    $body = $request->input('Body');

    // Do something with the SMS message
});
