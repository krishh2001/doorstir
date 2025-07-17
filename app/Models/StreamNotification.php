<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamNotification extends Model
{

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'date_time',
        'agora_way_url',
        'status'
    ];

     public function user()
{
    return $this->belongsTo(User::class);
}

public function service()
{
    return $this->belongsTo(Service::class);
}

public function provider()
{
    return $this->belongsTo(ServiceProvider::class);
}
}
