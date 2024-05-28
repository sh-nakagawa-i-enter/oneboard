@extends('layouts.app')

@section('content')
    @if(Auth::check())
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
                    </li>
                @endforeach
            </ul>
            {{-- ページネーションのリンク --}}
            {{ $boards->links() }}
        @endif
        
    </div>
    @endif
@endsection