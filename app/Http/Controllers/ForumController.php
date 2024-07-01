<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Models\Topic;

class ForumController extends Controller
{
    public function show(Forum $forum)
    {
        $topics = Topic::where('forum_id', $forum->id)->paginate(10);

        return view('forums.show', compact('forum', 'topics'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Вы не имеете права создавать новые форумы.');
        }

        $forum = new Forum();
        $forum->name = $request->name;
        $forum->save();

        return redirect()->route('main_page')->with('success', 'Новый форум успешно создан.');
    }
    public function destroy(Forum $forum)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Вы не имеете права удалять форумы.');
        }

        $forum->delete();
        return redirect()->route('main_page')->with('success', 'Форум успешно удален.');
    }
}
