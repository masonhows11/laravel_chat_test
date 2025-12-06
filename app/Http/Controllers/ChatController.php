<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function index()
    {
        $roomId = auth()->user()->rooms()->first()->id;
        return view('chat.room',['roomId'=>$roomId]);
    }
}
