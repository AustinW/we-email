<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input, Storage, Slack, Config;
use App\Email;

class EmailController extends Controller
{
    public function show($id)
    {
        $email = Email::with('attachments')->where('id', $id)->first();
        
        return view('email', ['email' => $email, 'content' => Storage::get(Config::get('app.emails') . '/' . $email->body_file)]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ( ! Input::has('headers.Subject') || ! Input::has('html')) {
            return response()->json(['error' => 'Invalid parameters', 'code' => 400], 400);
        }
        
        $subject = Input::get('headers.Subject');
        
        $html = Input::get('html');

        $emailFile = md5(time());

        Storage::put(Config::get('app.emails') . '/' . $emailFile, $html);
        
        $email = new Email;
        $email->reply_to = 'worldelitegym@gmail.com';
        $email->subject = $subject;
        $email->body_file = $emailFile;
        
        $email->save();

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                if ($attachment->isValid()) {
                    $fileName = md5($attachment->getFilename() . time());
                    $attachment->move(Config::get('app.attachments'), $fileName);

                    $email->attachments()->create([
                        'name' => $fileName,
                        'mime' => $attachment->getClientMimeType(),
                        'original_name' => $attachment->getClientOriginalName(),
                    ]);
                }
            }
        }
        
        Slack::send('<' . url('email/' . $email->id) . '|' . date('m/d/y') . ' - ' . $subject . '>');
    }
}
