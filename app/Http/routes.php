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
use App\Attachment;

Route::get('view/{email}', function($email) {
    if (Storage::exists('emails/' . $email)) {
        return view('email', ['title' => getEmailName($email), 'content' => Storage::get('emails/' . $email)]);
    } else {
        return view('message', [
            'title' => 'Not Found',
            'message' => 'The email you\'re looking for could not be found. Invalid link?'
        ]);
    }
});

Route::get('/', function() {
    $emails = App\Email::all();
    
    return view('emails', ['emails' => $emails]);
});

Route::get('attachment/{id}', ['as' => 'attachment', function($id) {
    $attachment = Attachment::find($id);

    if ($attachment) {
        return response()->download(Config::get('app.attachments') . '/' . $attachment->name, $attachment->original_name);
    } else {
        return response('Could not find the file specified', 404);
    }
}]);

Route::resource('email', 'EmailController', ['only' => ['show', 'store']]);
