<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $reply = new Reply();
        $reply->content = $request->response;
        $reply->topic_id = $topic->id;
        $reply->user_id = Auth::id();
        $reply->save();

         $repliesCount = $topic->replies()->count();
        $repliesPerPage = 10; 
        $lastPage = ceil($repliesCount / $repliesPerPage);

        return redirect()->route('topics.show', ['topic' => $topic->id, 'page' => $lastPage])
                         ->with('success', 'Комментарий успешно добавлен.');
    }

    public function destroy(Reply $reply)
    {
        if (Auth::user()->role !== 'admin' && Auth::id() !== $reply->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this reply.');
        }

        $reply->delete();
        return redirect()->back()->with('success', 'Reply deleted successfully.');
    }
}
