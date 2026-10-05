<header class="header navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <div class="header-area">
            <div class="logo">
                <a href="{{ route("frontend.home") }}">
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_light) }}" alt="{{ $sitesettings->site_title }}" class="logo-dark"/>
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" alt="{{ $sitesettings->site_title }}" class="logo-white"/>
                </a>
            </div>
            <div class="header-navbar">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="main_nav">
                        @if (count($menu) > 0)
                        <ul class="navbar-nav">
                            @foreach ($menu as $item)
                            <li class="nav-item">
                                <a class="nav-link{{ request()->url() == $item["href"] ? " active" : "" }}" href="{{ $item["href"] }}">{{ $item["text"] }}</a>
                            </li>
                            @endforeach
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/blog')}}">Blog</a>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tools
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{url('/calculator')}}">Online Calculator</a></li>
                                    <li><a class="dropdown-item" href="{{url('/base64/encoder')}}">Online Base64 Encoder</a></li>
                                    <li><a class="dropdown-item" href="{{url('/base64/decoder')}}">Online Base64 Decoder</a></li>
                                    <li><a class="dropdown-item" href="{{url('/Image_background/remover')}}">Online Image Background Remover</a></li>
                                    <li><a class="dropdown-item" href="{{url('/Image/compress')}}">Online Image Compressed</a></li>
                                    <li><a class="dropdown-item" href="{{url('/image-crop')}}">Online Image Cropper</a></li>
                                    <li><a class="dropdown-item" href="{{url('/age_calcluator')}}">Online Age Calculator</a></li>
                                    <li><a class="dropdown-item" href="{{url('/image_to/pdf')}}">Online Image To Pdf</a></li>
                                    <li><a class="dropdown-item" href="{{url('convert-pdf-to-word')}}">Online Pdf To Word</a></li>

                                </ul>
                            </li> --}}

                        </ul>
                        @endif
                    </div>
                </nav>
            </div>
            <div class="header-right">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round ">
                            <i class="lar la-sun icon-light"></i>
                            <i class="lar la-moon icon-dark"></i>
                        </span>
                    </label>
                </div>
                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>
                @auth
                <div class="botton-sub">
                    <a href="{{ route("dashboard.home") }}" class="btn-subscribe">Dashboard</a>
                </div>
                @else
                <div class="botton-sub">
                    <a href="{{ route("auth.login") }}" class="btn-subscribe">Log In</a>
                </div>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>
