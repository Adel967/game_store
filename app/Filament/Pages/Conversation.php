<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Message;
use App\Models\User;
use Filament\Forms;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Conversation extends Page
{
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-s-chat-bubble-left-right';
    protected static string $view = 'filament.pages.conversation';

    public $receiver_id = 1;
    public $messages;
    public $sendingMessage;
    public $allUsers = [];

    public function sendMessage()
    {
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->receiver_id,
            'message' => $this->sendingMessage,
            'isRead' => false,
        ]);
        $this->loadMessages();

        // Reset the message input
        $this->sendingMessage = '';
    }

    public function mount()
    {
        $this->getUsers();

        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::with(['sender', 'receiver'])
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $this->receiver_id)
                    ->orWhere(function ($query) {
                        $query->where('receiver_id', Auth::id())
                            ->where('sender_id', $this->receiver_id);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get()->reverse();
    }

    protected function getFormSchema(): array
    {

        return [
            Forms\Components\Select::make('receiver_id')
                ->label('Send to')
                ->relationship('receiver', 'name')
                ->required(),
            Forms\Components\Textarea::make('message')
                ->label('Message')
                ->required(),
        ];
    }

    public function getUsers()
    {
        if (Auth()->user()->role) {
            $this->allUsers = User::where('id', '!=', Auth::id())->get();
            $this->receiver_id = $this->allUsers->first()->id;
        } else {
            $this->allUsers = User::where('id', '==', Auth()->user()->role)->get();
        }
    }

    public function selectUser($userId)
    {
        $this->receiver_id = $userId;
        $this->markMessagesAsRead($userId);
        $this->loadMessages();
    }

    public function hasUnreadMessages($userId)
    {
        return  Message::where('sender_id', $userId)
            ->where('isRead', false)
            ->exists();
    }

    public function markMessagesAsRead($userId)
    {
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('isRead', false)
            ->update(['isRead' => true]);
    }
}
