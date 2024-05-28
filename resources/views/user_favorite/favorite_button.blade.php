{{-- @if (Auth::id() != $board->id) --}}
    @if (Auth::user()->is_favorites($board->message_id))
        {{-- お気に入り解除ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $board->message_id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-block normal-case" 
                onclick="return confirm('id = {{ $board->id }} のお気に入りを解除します。よろしいですか？')">お気に入り解除</button>
        </form>
    @else
        {{-- お気に入り登録ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $board->message_id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">お気に入り登録登録</button>
        </form>
    @endif
{{-- @endif --}}