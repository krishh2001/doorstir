<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingEntry extends Model
{
    //
    protected $fillable = [
        'user_id',
        'provider_id',
        'name',
        'url',
        'status'
    ];
}
