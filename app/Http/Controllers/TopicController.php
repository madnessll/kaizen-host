<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TopicController extends Controller
{
    public function show(Topic $topic, Request $request)
    {
        $forum = $topic->forum;
        $page = $request->get('page', 1);
        $replies = $topic->replies()->paginate(10, ['*'], 'page', $page);

        return view('topics.show', compact('topic', 'replies', 'forum'));
    }
    public function store(Request $request, Forum $forum)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Вы не имеете права создавать новые темы.');
        }

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->content = $request->content;
        $topic->forum_id = $forum->id;
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->route('forums.show', $forum->id)->with('success', 'Новая тема успешно создана.');
    }
    public function destroy(Topic $topic)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete this topic.');
        }

        $topic->delete();
        return redirect()->back()->with('success', 'Тема успешно удалена.');
    }
}
