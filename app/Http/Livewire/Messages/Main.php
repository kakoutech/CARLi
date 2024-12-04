<?php

namespace App\Http\Livewire\Messages;

use App\Models\Conversation;
use Livewire\Component;
use App\Models\User;

class Main extends Component
{
    public $conversation_id;
    public $message;
    public $user_id;

    public function mount($conversation_id = null)
    {
        $this->conversation_id = $conversation_id;
    }

    public function loadConversation($conversation_id)
    {
        $this->conversation_id = $conversation_id;
        $this->message = null;
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => ['required', 'min:5']
        ]);

        if ($this->conversation_id) {
            $conversation = auth()->user()->conversations()->find($this->conversation_id);
            if ($conversation) {
                $conversation->addMessage(auth()->user(), $this->message);
                $this->message = null;
            }
        }
    }

    public function newConversation()
    {
        $this->validate([
            'user_id' => ['required', 'exists:users,id'],
            'message' => ['required', 'min:5']
        ]);

        $user = User::find($this->user_id);
        if ($user) {
            $conversation = auth()->user()->startConversationWith($user);
            if ($conversation) {
                $conversation->addMessage(auth()->user(), $this->message);
                $this->loadConversation($conversation->id);
                $this->message = null;
            }
        }

        $this->emit('close-new-conversation-modal');
    }

    public function render()
    {
        $conversations = auth()->user()->conversations()->get();
        $conversation = null;
        if ($this->conversation_id) {
            $conversation = Conversation::find($this->conversation_id);
            if (!$conversation->canUserView(auth()->user())) {
                $conversation = null;
            } else {
                $conversation->markAsRead();
            }
        }

        return view(
            'livewire.messages.main',
            [
                'conversations' => $conversations,
                'current_conversation' => $conversation,
                'users' => User::select('id', 'first_name', 'last_name')->OrderBy('first_name', 'ASC')->get()
            ]
        );
    }
}
