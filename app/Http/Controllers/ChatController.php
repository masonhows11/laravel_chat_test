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
            $newMessage = Message::create([
                'user_id' => auth()->id(),
                'message' => $request->message,
                'room_id' => (int)$request->room_id,

            ]);
            event(new MessageSentEvent($newMessage,auth()->user()));
            return response()->json($newMessage);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function getTasks()
    {

        return response()->json([
            'tasks' => Task::all()
        ], 200);
    }
}
