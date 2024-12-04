<?php

namespace App\Models;

use App\Notifications\ConversationMessageRecieved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_reply_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function user()
    {
        if (auth()->user()->id != $this->sender_id) {
            return $this->sender();
        }

        return $this->receiver();
    }

    public function getLastMessageTime()
    {
        return $this->last_reply_at ? $this->last_reply_at->diffForHumans() : null;
    }

    public function getLastMessagePreview()
    {
        $message = $this->messages()->latest()->first();
        if ($message) {
            return $message->message;
        }

        return null;
    }

    public function getUnreadMessageCount()
    {
        return $this->messages()->where('unread', '=', 1)->where('user_id', '!=', auth()->user()->id)->count();
    }

    public function messages()
    {
        return $this->hasMany(ConversationMessage::class, 'conversation_id', 'id');
    }

    public function canUserView(User $user)
    {
        return $this->sender_id == $user->id || $this->receiver_id == $user->id;
    }

    public function markAsRead()
    {
        foreach ($this->messages()->where('unread', '=', 1)->where('user_id', '!=', auth()->user()->id)->get() as $message) {
            $message->unread = 0;
            $message->save();
        }
    }

    public function addMessage(User $user, $message = null)
    {
        $item = new ConversationMessage();
        $item->conversation_id = $this->id;
        $item->user_id = $user->id;
        $item->message = $message;
        $item->unread = 1;
        $item->save();

        $this->last_reply_by = $user->id;
        $this->last_reply_at = now();
        $this->save();

        if (auth()->check()) {
            $this->user->notify(new ConversationMessageRecieved($this));
        }
    }
}
