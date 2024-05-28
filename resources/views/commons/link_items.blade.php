@if (Auth::check())
    {{-- ユーザー一覧ページへのリンク
    <li><a class="link link-hover" href="{{ route('user.index') }}">Users</a></li> --}}
    {{-- ユーザー詳細ページへのリンク
    <li><a class="link link-hover" href="{{ route('user.show', Auth::user()->id) }}">{{ Auth::user()->name }}&#39;s profile</a></li>
    <li class="divider lg:hidden"></li> --}}
    {{-- ログインユーザの名前 --}}
    <li><a href="/">{{ Auth::user()->user_name }}さんのページ</a></li>
    {{-- <p class="user_name">{{ Auth::user()->user_name }}さんのページ</p> --}}
    <li><a href="{{ route('favorites.index')}}">お気に入り一覧</a></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif