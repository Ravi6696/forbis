<?php

namespace App\View\Components;

use App\Models\Conversation as ModelsConversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Conversation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user_id = Auth::user()->id;
        $users = User::role('user')->get()->except(Auth::id());
        foreach ($users as $key => $user) {
            $user_id = $user->id;
            $user->coversation  = ModelsConversation::where(function ($q) use ($user_id) {
                $q->where('sender_id', auth()->user()->id)
                    ->Where('receiver_id', $user_id);
            })
                ->orWhere(function ($q) use ($user_id) {
                    $q->where('sender_id', $user_id)
                        ->Where('receiver_id', auth()->user()->id);
                })
                ->first();
        }
        $users = $users->sortByDesc('coversation.last_message');
        return view('components.conversation', compact('users'));
    }
}