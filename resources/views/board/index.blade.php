@extends('layouts.app')

@section('content')

    <div class="sm:col-span-2 main-content">
        {{-- 投稿フォーム --}}
        @include('microposts.form')
        {{-- 投稿一覧
        @include('microposts.microposts') --}}
    </div>

    @if (isset($boards))
        <ul class="list-none">
            @foreach ($boards as $board)
                <li class="list-content">
                    <div class="flex items-start v-list">
                        <div>
                            {{-- 投稿者名と投稿内容 --}}
                            <p class="text-name">{{ $board->user_name }}</p>
                            <p class="text-message">{{ $board->message }}</p>
                        </div>
                        <div>
                            {{-- 時間 --}}
                            <span class="text-muted text-gray-500">{{ $board->created_at->format('Y年m月d日 H:m') }}</span>
                        </div>
                    </div>
                    <div class="buton">
                        <form action="{{ route('board.update', $board->message_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <button type="submit" class="butn">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $boards->links() }}
        @else
            <p class="db-none">{{ $message }}</p>
    @endif

    
    
    {{-- メッセージ作成ページへのリンク
    <a class="btn btn-primary" href="{{ route('board.create') }}">新規メッセージの投稿</a> --}}

@endsection