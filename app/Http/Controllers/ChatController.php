<?php

namespace App\Http\Controllers;

use App\Events\MessageDeleteEvent;
use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    //
    public function index()
    {
        try {
            $roomId = auth()->user()->rooms()->first()->id;
            $messages = Message::with('user')
                ->where('room_id', $roomId)
                ->orderBy('created_at')
                ->get();
            return view('chat.room', ['roomId' => $roomId, 'messages' => $messages]);
        } catch (\Exception $e) {
            return view('errors.404');
        }
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
            event(new MessageSentEvent($roomId, $message, auth()->user()));
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }


    public function delete(Request $request)
    {

        try {
            $message = Message::find($request->message_id);
            if (!empty($message)) {
                $roomId = $message->room_id;
                $messageId = $message->id;
                if (auth()->id() == $message->user_id) {
                    Message::destroy($request->message_id);
                    event(new MessageDeleteEvent($roomId, $messageId, auth()->user()));
                    return response()->json(['success' => true ,'msg' => 'your fucking message was deleted'], 200);
                } else {
                    return response()->json(['success' => false ,'msg' => 'You do not have permission to delete.'], 403);
                }
            } else {
                return response()->json(['success' => false ,'msg' => 'The requested data does not exist.'], 404);
            }
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
