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

Route::get('all', function() {
    $files = str_replace('emails/', '', Storage::files('emails'));
    
    $names = array_map(function($file) {
        $file = substr_replace($file, '', -6, 6);
        
        $pieces = explode('-', $file);
        
        $date = $pieces[0] . '-' . $pieces[1] . '-' . $pieces[2];
        
        $name = $date . ' ' . ucwords(implode(' ', array_slice($pieces, 3)));
        
        return $name;
    }, $files);
    
    $emails = array_combine($files, $names);
    
    return view('emails', ['emails' => $emails]);
});

Route::resource('email', 'EmailController', ['only' => ['store']]);
