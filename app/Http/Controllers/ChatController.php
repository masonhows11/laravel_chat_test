<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

    public function store(Request $request){

        return Message::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'message' => $request->message,
        ]);

    }
}
