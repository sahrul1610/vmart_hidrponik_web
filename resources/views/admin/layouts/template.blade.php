<!DOCTYPE html>
<html lang="en">

<head>
    <meta>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') &mdash; Vmart</title>
    @include('admin.layouts.partials_admin.css.css')
    @yield('css_select2')
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        <header class="header-navbar fixed">
            <div class="toggle-mobile action-toggle"><i class="fas fa-bars"></i></div>
            <div class="header-wrapper">
                <div class="header-left">
                    <div class="theme-switch-icon"></div>
                </div>
                <div class="header-content">
                    <div class="notification dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-envelope"></i>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Message</a>
                            </li>
                            {{-- <li class="menu-content ps-menu">
                                @php
                                    $comments = app('App\Models\Comment')->all()->take(5);
                                    $prevUserName = null;
                                    $reversedComments = $comments->reverse();
                                @endphp
                                @forelse($reversedComments as $comment)
                                    @if ($comment->transaction->user->name != $prevUserName)

                                        <a href="#">
                                            <div class="message-image">
                                                <img src="{{ url('/template') }}/assets/images/avatar1.png"
                                                    class="rounded-circle w-100" alt="user1">
                                            </div>
                                            <div class="message-content read">
                                                <div class="subject">
                                                    {{ $comment->transaction->user->name }}
                                                </div>
                                                <div class="body">

                                                    {{ \Illuminate\Support\Str::words($comment->comment, 5, '...') }}
                                                </div>
                                                <div class="time">{{ $comment->created_at->diffForHumans() }}</div>
                                            </div>
                                        </a>
                                    @endif

                                    @php
                                        $prevUserName = $comment->transaction->user->name;
                                    @endphp


                                @empty
                                    <p>No comments available.</p>
                                @endforelse
                            </li> --}}
                            <li class="menu-content ps-menu">
    @php
        $transactions =app('App\Models\Transaksi')->with('comments')->whereHas('comments', function ($q){
            $q->orderBy('comment', 'DESC');
        })->get()->take(5);
        $prevUserName = null;
        $reversedTransactions = $transactions->reverse();
    @endphp
    @forelse($reversedTransactions as $transaction)
        @if ($transaction->user->name != $prevUserName)
            {{-- Tampilkan transaksi jika nama pengguna berbeda --}}
            <a href="#">
                <div class="message-image">
                    <img src="{{ url('/template') }}/assets/images/avatar1.png" class="rounded-circle w-100" alt="user1">
                </div>
                <div class="message-content read">
                    <div class="subject">
                        {{ $transaction->user->name }}
                    </div>
                    <div class="body">
                        {{ \Illuminate\Support\Str::words($transaction->comments[0]['comment'], 5, '...') }} <!-- Batasi komentar menjadi 5 kata -->
                    </div>
                    <div class="time">{{ $transaction->comments[0]['created_at']->diffForHumans() }}</div>
                </div>
            </a>
        @endif

        @php
            $prevUserName = $transaction->user->name; // Update nilai nama pengguna sebelumnya
        @endphp
    @empty
        <p>No transactions available.</p>
    @endforelse
</li>

                        </ul>
                    </div>

                    {{-- @include('admin.layouts.comment') --}}
                    <div class="dropdown dropdown-menu-end">
                        <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="label">
                                <span></span>
                                @auth
                                    <div>{{ auth()->user()->name }}</div>
                                @else
                                    <div>Admin</div>
                                @endauth
                            </div>
                            <img class="img-user" src="{{ url('/template') }}/assets/images/avatar1.png"
                                alt="user"srcset="">
                        </a>
                        <ul class="dropdown-menu small">
                            <li class="menu-content ps-menu">
                                <a href="{{ url('/profile') }}">
                                    <div class="description">
                                        <i class="ti-user"></i> Profile
                                    </div>
                                </a>
                                <a href="{{ url('/logout') }}">
                                    <div class="description">
                                        <i class="ti-power-off"></i> Logout
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </header>
        <nav class="main-sidebar ps-menu">
            <div class="sidebar-toggle action-toggle">
                <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <div class="sidebar-opener action-toggle">

                <a href="#">
                    <i class="ti-angle-right"></i>
                </a>
            </div>
            <div class="sidebar-header">
                <div class="text"><img src="{{ asset('template/assets/images/logo.png')}}" alt="" style="width: 150px; height:60px;"></div>
                <div class="close-sidebar action-toggle">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div class="sidebar-content">

                @include('admin.layouts.navbar.navbar')
            </div>
        </nav>
        <div class="main-content">
            <div class="title">
                @yield('title')
            </div>
            @yield('content')

        </div>

        <div class="settings">
            <div class="settings-icon-wrapper">
                <div class="settings-icon">
                    <i class="ti ti-settings"></i>
                </div>
            </div>
            <div class="settings-content">
                <ul>
                    <li class="fix-header">
                        <div class="fix-header-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixHeader">Fixed Header</label>
                                <input class="form-check-input toggle-settings" name="Header" type="checkbox"
                                    id="settingsFixHeader">
                            </div>
                        </div>
                    </li>
                    <li class="fix-footer">
                        <div class="fix-footer-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixFooter">Fixed Footer</label>
                                <input class="form-check-input toggle-settings" name="Footer" type="checkbox"
                                    id="settingsFixFooter">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="theme-switch">
                            <label for="">Theme Color</label>
                            <div>
                                <div class="form-check form-check-inline lg">
                                    <input class="form-check-input lg theme-color" type="radio" name="ThemeColor"
                                        id="light" value="light">
                                    <label class="form-check-label" for="light">Light</label>
                                </div>
                                <div class="form-check form-check-inline lg">
                                    <input class="form-check-input lg theme-color" type="radio" name="ThemeColor"
                                        id="dark" value="dark">
                                    <label class="form-check-label" for="dark">Dark</label>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="fix-footer-wrapper">
                            <div class="form-check form-switch lg">
                                <label class="form-check-label" for="settingsFixFooter">Collapse Sidebar</label>
                                <input class="form-check-input toggle-settings" name="Sidebar" type="checkbox"
                                    id="settingsFixFooter">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <footer>
            Copyright © 2023 &nbsp <a href="#" target="_blank" class="ml-1"> Web Vmart Hidroponik </a> <span>
                . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    @include('admin.layouts.partials_admin.js.style_js')
    @yield('page_scripts')
</body>

</html>
