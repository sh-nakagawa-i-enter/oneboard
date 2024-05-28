@extends('layouts.app')

@section('content')
    @if (Auth::check())
    <div class="sm:col-span-2 main-content">
        {{-- 投稿フォーム --}}
        @include('microposts.form')
        {{-- 投稿一覧
        @include('microposts.microposts') --}}
    </div>

    <div>
        @if (isset($boards))
            <ul class="list-none">
                @foreach ($boards as $board)
                    <li class="list-content">
                        <div>
                            <div class="micropost">
                                {{-- 投稿者名 --}}
                                <p class="text-name">{{ $board->user->user_name }}</p>
                                {{-- 時間 --}}
                                <span class="text-muted text-gray-500">{{ $board->created_at->format('Y年m月d日 H:m') }}</span>
                            </div>
                            <div>
                                {{-- 投稿内容 --}}
                                <p class="text-message">{{ $board->message }}</p>
                            </div>
                        </div>
                        
                        <div class="btn-group">
                            {{-- 自分の投稿を削除するボタン --}}
                            @if (\Auth::id() === $board->user_id)
                                <div class="buton">
                                    <form action="{{ route('board.update', $board->message_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <button type="submit" class="butn">削除</button>
                                    </form>
                                </div>
                            @endif
                            {{-- お気に入りボタン --}}
                            <div>
                                @include('user_favorite.favorite_button')
                            </div>
                        </div>
                        
                    </li>
                @endforeach
            </ul>
            {{-- ページネーションのリンク --}}
            {{ $boards->links() }}
            @else
                <p class="db-none">{{ $message }}</p>
        @endif
    </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to the Microposts</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
                </div>
            </div>
        </div>
    @endif
    
    {{-- メッセージ作成ページへのリンク
    <a class="btn btn-primary" href="{{ route('board.create') }}">新規メッセージの投稿</a> --}}

@endsection