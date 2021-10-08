<?php

namespace App\View\Components;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Chat extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public  $conversation, $id;
    public function __construct($id = null)
    {
        $this->id = $id;
        $this->conversation = Conversation::find($id);
        if ($id == null) {
            $conversations = Conversation::where('sender_id', auth()->user()->id)
                ->orWhere('receiver_id', auth()->user()->id)
                ->get()
                ->sortByDesc('last_message');
            $this->conversation = $conversations->first();
            $this->id = $this->conversation->id ?? null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $id = $this->id;
        $chats = ConversationMessage::when($id != null, function ($q) use ($id) {
            $q->where('conversation_id', $id);
        })->paginate(4);
        return view('components.chat', ['conversation' => $this->conversation, 'chats' => $chats]);
    }
}