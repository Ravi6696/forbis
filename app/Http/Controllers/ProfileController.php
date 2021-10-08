<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        // dd($user->favourites->company->companyCategory());
        return view('profile.index', compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email,' . $request->user_id . ',id',
            'postal_code' => 'nullable|digits:5'
        ]);
        try {
            list($first_name, $last_name) = explode(' ', $request->name);
            $objUser = User::firstOrNew(['id' => $request->user_id]);
            $objUser->first_name = $first_name;
            $objUser->last_name = $last_name;
            $objUser->email = $request->email;
            if ($request->profile_pic) {
                $file = $request->profile_pic;
                $file_name = Storage::disk('uploads')->put("user_profile", $file);
                $objUser->profile_pic = $file_name;
            }
            if ($objUser->save()) {
                $objUser->address()->update([
                    'postalcode' => $request->postal_code,
                    'city' => $request->city,
                ]);
                $result['key'] = 1;
                $result['message'] = "Profile Saved Successfully !";
            } else {
                $result['key'] = 0;
                $result['message'] = "Something went wrong !";
            }
        } catch (Exception $e) {
            $result['key'] = 0;
            $result['message'] = $e->getMessage();
        }
        return response()->json($result);
    }

    //controller
    public function send(Request $request)
    {
        try {
            $conversation = $this->Conversation->find(request('conversation_id'));
            if (!$conversation) {
                $conversation = $this->Conversation->Create(
                    [
                        'sender_id' => auth()->user()->id,
                        'receiver_id' => request('user_id'),
                    ]
                );
            }
            $this->ConversationMessage->Create(
                [
                    'conversation_id' => request('conversation_id') ?? $conversation->id,
                    'message' => request('message'),
                    'type' => 'text',
                    'user_id' => auth()->user()->id
                ]
            );
            //sender msg design
            $msg_for_sender =
                '<div class="row text-msg  receive-message">
                    <div class="perpal-text-msg">
                        <p class="text-inmsg">' . request('message') . ' </p>
                    </div>
                    <div class="text-msg-profile">
                        <img src="' . auth()->user()->profile_path . '">
                    </div>
                </div>';
            $users = $this->User->role('user')->get()->except(Auth::id());
            foreach ($users as $key => $user) {
                $user_id = $user->id;
                $user->coversation  = $this->Conversation->where(function ($q) use ($user_id) {
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
            $html = view('components.conversation', compact('users'))->render();
            $result = [
                'send_msg' => $msg_for_sender,
                'conversation' => $html,
            ];
            return getResponse(1, __('message.sent', ['attribute' => 'Message']), $result);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function getConversation()
    {
        try {
            $conversation_id = request('conversation_id');
            $user_id = request('user_id');
            $conversation = $this->Conversation->find($conversation_id);
            $chats = $this->ConversationMessage->where('conversation_id', $conversation_id)->paginate(4);
            $html = view('components.chat', compact('conversation', 'chats', 'user_id'))->render();
            return getResponse(1, __('message.sent', ['attribute' => 'Message']), $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function deleteConversation()
    {
        try {
            $conversation_id = request('conversation_id');
            $conversation = $this->Conversation->find($conversation_id);
            $conversation->delete();
            $conversation->conversationMessages()->delete();
            return getResponse(1, __('message.deleted', ['attribute' => 'Conversation']), $conversation);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    //conversation get and start chat and list of conversation

    public function chatModule()
    {
        $role = 'Pharmacy';
        $data = request()->all();
        $provider_id = isset($data['provider']) ? decrypt(request('provider')) : null;
        $authPharmacyId = $data['authPharmacyId'];
        if ($provider_id) {
            $conversations = $this->Conversation->where(function ($query) use ($provider_id) {
                $query->where('sender_id', $provider_id)
                    ->orwhere('receiver_id', $provider_id);
            })->where(function ($query) use ($authPharmacyId) {
                $query->where('sender_id', $authPharmacyId)
                    ->orwhere('receiver_id', $authPharmacyId);
            })->first();
            if (!$conversations) {
                $this->Conversation->create(['sender_id' => $data['authPharmacyId'], 'receiver_id' => $provider_id]);
            }
        }
        if (request()->ajax()) {
            $store_id = request('authPharmacyId');
            $lists = $this->Conversation->where(function ($query) use ($store_id) {
                $query->where('sender_id', $store_id)
                    ->orwhere('receiver_id', $store_id);
            })->paginate(20);
            return response()->json(
                View::make('web.chat.chat_raw', compact('lists', 'role'))
                    ->render()
            );
        }
        return view('web.chat.chat_list');
    }

    public function chatConverstion($id)
    {
        $role = 'Pharmacy';
        $store_id = request('authPharmacyId');
        $chat_details = $this->Conversation->where('id', $id)->first();
        $conversations_list = $this->ConversationMessage->where('conversation_id', $id)->get();
        $receiver_id = $chat_details['sender_id'] == $store_id ? $chat_details['receiver_id'] : $chat_details['sender_id'];
        $user_deatils = $this->User->where('id', $receiver_id)->first();
        $check_user = 'chat_module' . $id . $store_id;
        return response()->json(
            View::make('web.chat.chat_popup', compact('conversations_list', 'chat_details', 'user_deatils', 'check_user', 'role'))
                ->render()
        );
    }
}