{{-- @if (Auth::id() == $user->id) --}}
    <div class="mt-4">
        <form method="POST" action="{{ route('board.store') }}">
            @csrf
            
            {{-- 投稿者名記入欄 
            <div class="text-box">
                <div class="error_alert">
                    <h2 class="board-name">投稿者名</h2>
                    <span class="emg">@include('commons.error_20messages')</span>
                </div>
                <input type="text" rows="2" name="user_name" class="name-box">
            </div>
            --}}
        
            <div class="text-box">
                <div class="error_alert">
                    <h2 class="board-name">ひとことメッセージ</h2>
                    <span class="emg">@include('commons.error_140messages')</span>
                </div>
                <input type="text" rows="2" name="message" class="message-box">
            </div>
        
            <button type="submit" class="butn">投稿する</button>
        </form>
    </div>
{{-- @endif --}}