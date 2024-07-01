@extends('layouts.app')

@section('title', 'Kaizen')

@section('content')
<section class="questions">
    @foreach ($forums as $forum)
        <div class="question">
            <a href="{{ route('forums.show', $forum->id) }}" class="question__forum">{{ $forum->name }}</a>
            @auth
                @if (Auth::user()->role === 'admin')
                    <form action="{{ route('forums.destroy', $forum->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="question__delete-btn">Удалить форум</button>
                    </form>
                @endif
            @endauth
            @php $count = 0; @endphp
            @foreach ($forum->topics as $topic)
                @if ($count >= 5)
                    @break
                @endif
                <div class="question__descr">
                    <div class="question__descr-left">
                        <a href="{{ route('topics.show', $topic->id) }}" class="question__descr-left-name">{{ $topic->title }}</a>
                        <div class="question__descr-left-descr">{{ $topic->content }}</div>
                    </div>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <form action="{{ route('topics.destroy', $topic->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="question__delete-btn-descr">Удалить тему</button>
                            </form>
                        @endif
                    @endauth
                    <a href="{{ route('topics.show', $topic->id) }}" class="question__descr-link"></a>
                </div>
                @php $count++; @endphp
            @endforeach
        </div>
    @endforeach
</section>
<div class="pagination questions__pagination">
    {{ $forums->links() }} <!-- Вывод пагинационных ссылок для форумов -->
</div>
@auth
    @if (Auth::user()->role === 'admin')
        <div class="questions__form">
            <form action="{{ route('forums.store') }}" method="POST">
                @csrf
                <label class="questions__answer" for="name">Название форума</label>
                <input type="text" class="questions__form-text" id="name" name="name" required>
                <div class="questions__form-wrapper">
                    <button type="submit" class="forum-topics__form-btn">Создать</button>
                </div>
            </form>
        </div>
    @endif
@endauth
@endsection