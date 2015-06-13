<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMimeMailParser\Parser;

use Storage;

class EmailParserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses an incoming email.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parser = new Parser();
        $parser->setStream(fopen("php://stdin", "r"));

        $to = $parser->getHeader('to');
        $from = $parser->getHeader('from');
        $subject = $parser->getHeader('subject');
        $text = $parser->getMessageBody('html');
        
        $date = date('m-d-y');
        
        $rand = substr(md5(time()), 0, 5);
        
        Storage::put('emails/' . $date . '-' . str_slug($subject) . '-' . $rand, $text);
    }
}
