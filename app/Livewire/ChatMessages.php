<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatMessages extends Component
{
    #[Validate('required|string')]
    public $body = '';

    public $friendId;
    public $messages;

    public function mount($friendId)
    {
        $this->friendId = $friendId;
        $this->messages = Message::where(function ($q) {
            $q->where('sender_id', Auth::id())
                ->where('receiver_id', $this->friendId);
        })->orWhere(function ($q) {
            $q->where('sender_id', $this->friendId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $this->messages = collect($this->messages); // ✅ force into Collection
    }

    public function sendMessage()
    {
        $this->validate();

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $this->friendId,
            'body'        => $this->body,
        ]);

        // Broadcast to others in real-time


        // Add the new message locally
        $this->messages->push($message);

        $this->reset('body');
    }


    public function render()
    {
        $friend = User::findOrFail($this->friendId);

        return view('livewire.chat-messages', [
            'friend'   => $friend,
            'messages' => $this->messages,
        ]);
    }
}
