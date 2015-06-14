<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input, Storage, Slack;
use App\Email;

class EmailController extends Controller
{
    public function show($id)
    {
        $email = Email::find($id);
        
        return view('email', ['email' => $email, 'content' => Storage::get($email->body_file)]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $subject = Input::get('headers.Subject');
        
        $html = Input::get('html');
        
        $emailFile = md5(time());
        
        Storage::put($emailFile, $html);
        
        $email = new Email;
        $email->reply_to = 'worldelitegym@gmail.com';
        $email->subject = $subject;
        $email->body_file = $emailFile;
        
        $email->save();
        
        Slack::send('<' . url('email/' . $email->id) . '|' . date('m/d/y') . ' - ' . $subject . '>');
    }
}
