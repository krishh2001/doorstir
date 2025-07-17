<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

  protected $fillable = ['email', 'password'];


    protected $hidden = [
        'password', 'remember_token',
    ];

     public function getUserMeetingInfo(){
        return $this->hasMany(UserMeeting::class, 'user_id','id');
    }
}
