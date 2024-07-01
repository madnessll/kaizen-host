@extends('layouts.app')

@section('title', 'Topic Details')

@section('content')
<section class="discussion">
    <div class="discussion__btn-back-wrapper">
        <a href="{{ route('forums.show', $forum->id) }}" class="discussion__btn-back">Назад</a>
    </div>
    <h1 class="discussion__topic">{{ $topic->title }}</h1>
    @foreach ($replies as $reply)
        <div class="discussion__replies replies">
            <div class="replies__wrapper">
                <div class="replies__name">Имя: {{ $reply->user->name }}</div>
                <div class="replies__date">{{ $reply->created_at->format('H:i, d M Y') }}</div>
            </div>
            <div class="replies__comment">{{ $reply->content }}</div>
            @auth
                @if (Auth::user()->role === 'admin' || Auth::id() === $reply->user_id)
                    <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="replies__delete-btn">Удалить</button>
                    </form>
                @endif
            @endauth
        </div>
        <div class="replies__black"></div>
    @endforeach
    <div class="pagination">
        {{ $replies->links() }}
    </div>
    <div class="discussion__form">
        @auth
            <form action="{{ route('replies.store', $topic->id) }}" method="POST">
                @csrf
                <label class="discussion__answer" for="response">Ответить</label>
                <textarea class="discussion__form-text" id="response" name="response"></textarea>
                <div class="discussion__wrapper">
                    <button type="submit" class="discussion__btn">Отправить</button>
                </div>
            </form>
        @else
            <p>Пожалуйста, <a href="{{ route('login') }}">войдите в систему</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>, чтобы оставить комментарий.</p>
        @endauth
    </div>
</section>
@endsection
