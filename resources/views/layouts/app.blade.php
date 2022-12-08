<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML Meta Tags -->
    <title>IPTV Online by Viet-TV</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/web-info/logo/logo.jpg')}}" />
    <meta name="description"
        content="Xem truyền hình Online by Viet-TV | Truyền hình dành riêng cho người Việt tại nước ngoài | Chi tiết liên hệ Zalo: +84983775500">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="IPTV Online by Viet-TV">
    <meta itemprop="description"
        content="Xem truyền hình Online by Viet-TV | Truyền hình dành riêng cho người Việt tại nước ngoài | Chi tiết liên hệ Zalo: +84983775500">
    <meta itemprop="image"
        content="http://m.gettywallpapers.com/wp-content/uploads/2022/07/Fifa-World-Cup-Qatar-2022-Pictures-Photos4.jpg">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="http://viet-tv.vn">
    <meta property="og:type" content="website">
    <meta property="og:title" content="IPTV Online by Viet-TV">
    <meta property="og:description"
        content="Xem truyền hình Online by Viet-TV | Truyền hình dành riêng cho người Việt tại nước ngoài | Chi tiết liên hệ Zalo: +84983775500">
    <meta property="og:image"
        content="http://m.gettywallpapers.com/wp-content/uploads/2022/07/Fifa-World-Cup-Qatar-2022-Pictures-Photos4.jpg">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="IPTV Online by Viet-TV">
    <meta name="twitter:description"
        content="Xem truyền hình Online by Viet-TV | Truyền hình dành riêng cho người Việt tại nước ngoài | Chi tiết liên hệ Zalo: +84983775500">
    <meta name="twitter:image"
        content="http://m.gettywallpapers.com/wp-content/uploads/2022/07/Fifa-World-Cup-Qatar-2022-Pictures-Photos4.jpg">
    <!-- Meta Tags Generated via http://heymeta.com -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/04e9a3dbb4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <link href="{{ asset('css/app.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/index.css?v=') . time() }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

</head>
<body>
    @php
        use App\Admin;
    @endphp
    <style>
    </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="position:fixed; width: 100%; z-index:1002; border:0px; padding:0px;background:#840123; ">
            <div class="container" style="height : 100%; padding:0px;">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin: 0px 16px; color:white; font-size:30px; width:100%; text-align:center;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler"  style="margin-right: 10px; position:absolute; right:0px;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto " style="background:#840123; color:white;">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a  style="color:white; font-size: 15px; text-align:left;  margin:0px 10px; width:auto;" class="nav-link" href="{{ route('auth.login') }}">Đăng Nhập</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown" style="z-index:1005;" style="background:#840123; color:white;">
                                <a style="color:white; font-size: 15px; text-align:left; margin:0px 10px; width:auto;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background:#840123; color:white; border-radius:0px !important; ">
                                    <a class="dropdown-item" style="cursor: pointer; color:white !important;"
                                       onclick="event.preventDefault();
                                                     document.getElementById('home-form').submit();">
                                        <i class="fa-solid fa-house"></i>    <span>Trang Chủ</span>
                                    </a>
                                    @if(Admin::user()->inRoles([ROLE_ADMIN, ROLE_SUPER_ADMIN]))
                                        <a class="dropdown-item" style="cursor: pointer;color:white !important;"
                                            onclick="event.preventDefault();
                                                        document.getElementById('accountManager-form').submit();">
                                            <i class="fa-solid fa-users"></i>    <span>Quản Lý Tài Khoản</span>
                                        </a>
                                    @endif
                                    <a class="dropdown-item" style="cursor: pointer;color:white !important;"
                                       onclick="event.preventDefault();
                                                     document.getElementById('changePassword-form').submit();">
                                        <i class="fa-solid fa-lock"></i>    <span>Đổi Mật Khẩu</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('auth.logout') }}" style="color:white !important;"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>   <span>Đăng Xuất</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
                                    <form id="changePassword-form" action="{{ route('auth.password.change') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>

                                    <form id="accountManager-form" action="{{ route('admin.accountManager') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>

                                    <form id="home-form" action="{{ route('home') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
