<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ひとこと掲示板</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @vite('resources/css/app.css')
    </head>

    <body class="background">

        {{-- ナビゲーションバー
        @include('commons.navbar') --}}
        
        <h1 class="title-hitokoto">ひとこと掲示板</h1>
        
        {{-- フラッシュメソッド --}}
        @if(session('result'))
        	<div class="save">
        		{{ session('result') }}
        	</div>
        @endif
        @if(session('noresult'))
        	<div class="not-save">
        		{{ session('noresult') }}
        	</div>
        @endif

        <div class="container mx-auto">
            {{-- エラーメッセージ
            @include('commons.error_messages') --}}

            @yield('content')
        </div>
        <footer class="foot">
            <p>© TechAcademy Lesson22 ひとこと掲示板</p>
        </footer>

    </body>
</html>