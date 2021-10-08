<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Auth;

class ChatController extends BaseController
{
    public function messageView()
    {
        return view('pro-user.messages');
    }
    
    public function chatList()
    {
        $store_id = Auth::user()->id;
        $user = Auth::user();
        $location = [
            'name' => 'latitude',
            'message' => 'longitude',
        ];
        broadcast(new ChatEvent($location, $user));
        $lists = $this->Conversation->where(function ($query) use ($store_id) {
            $query->where('sender_id', $store_id)
                ->orwhere('receiver_id', $store_id);
        })->paginate(20);
        $html = view('pro-user.chat-message-list', ['lists' => 'lists'])->render();
        return response()->json(['html' => $html]);
    }
}
