<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }
}
