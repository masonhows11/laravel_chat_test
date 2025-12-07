<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';

    protected $fillable = [
        'user_id',
        'message',
        'room_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
