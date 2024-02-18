<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function SendMessage(Request $request){
         $request->validate([
            'msg' => 'required',
        ]);

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'msg' => $request->msg,
            'created_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Message sent successfully.']);
    }

    public function GetAllUsers(){
        $chats = ChatMessage::orderBy('id','DESC')
                ->where('sender_id', Auth::id())
                ->orWhere('receiver_id', Auth::id())->get();

        $user = $chats->flatMap(function ($chat){
            if ($chat->sender_id === Auth::id()){
                return [$chat->sender, $chat->receiver];
            }
            return [$chat->receiver, $chat->sender];
        })->unique();

        return $chats;
    }
}
