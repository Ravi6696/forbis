<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends BaseModel
{
    use SoftDeletes;
    use HasFactory;
    protected $appends = ['last_message'];
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }
    public function conversationMessages()
    {
        return $this->hasMany(ConversationMessage::class);
    }
    public function getLastMessageAttribute()
    {
        return $this->conversationMessages()->latest('created_at')->first();
    }
}