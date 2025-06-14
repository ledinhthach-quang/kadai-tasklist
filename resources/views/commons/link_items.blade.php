@if (Auth::check())
    {{-- TEST LINE --}}
    {{-- ユーザー一覧ページへのリンク --}}
    <li><a class="link link-hover" href="#">Users</a></li>
    {{-- ユーザー詳細ページへのリンク --}}
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif