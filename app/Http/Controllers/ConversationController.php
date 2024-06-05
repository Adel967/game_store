<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request, $userId = null)
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $messages = collect();

        if ($userId) {
            $messages = Message::with(['sender', 'receiver'])
                ->where(function ($query) use ($userId) {
                    $query->where('sender_id', auth()->id())
                        ->where('receiver_id', $userId);
                })
                ->orWhere(function ($query) use ($userId) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', auth()->id());
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('conversation', compact('users', 'messages'));
    }
}
