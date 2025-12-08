<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\Task;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function index()
    {
        $roomId = auth()->user()->rooms()->first()->id;
        return view('chat.room', ['roomId' => $roomId]);
    }

    public function store(Request $request)
    {
        try {

            $message = Message::create([
                'user_id' => auth()->id(),
                'message' => $request->message,
                'room_id' => (int)$request->room_id,
            ]);

            $roomId = $message->room_id;
            event(new MessageSentEvent($roomId,$message,auth()->user()));
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
        //return response()->json(['success' => true]);
    }

    public function getTasks()
    {

        return response()->json([
            'tasks' => Task::all()
        ], 200);
    }
}
