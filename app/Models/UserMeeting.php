<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeeting extends Model
{
    //
    protected $fillable = [
        'user_id',
        'app_id',
        'token',
        'appcertificate',
        'channel',
        'url',
        'uid'
    ];
}
