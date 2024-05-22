@if (isset($errors))
        @foreach ($errors->all() as $error)
            <div class="error_messages">
                <div>
                    <p>※20文字以内で入力してください</p>
                </div>
            </div>
        @endforeach
@endif