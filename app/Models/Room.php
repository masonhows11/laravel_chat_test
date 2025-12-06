<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //

    public function users()
    {
         return $this->belongsToMany(User::class,'room_user');
    }

   
}
