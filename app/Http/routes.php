<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('view/{email}', function($email) {
    if (Storage::exists('emails/' . $email)) {
        echo Storage::get('emails/' . $email);
    } else {
        return view('message', [
            'title' => 'Not Found',
            'message' => 'The email you\'re looking for could not be found. Invalid link?'
        ]);
    }
});
