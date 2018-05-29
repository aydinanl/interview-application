<!DOCTYPE html>
<html>
<head>
    <title>@if(isset($settings) && $settings['site_title']){{$settings['site_title']}}@endif
        - @yield('pagetitle')
    </title>

    <!-- new -->

    <meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1.0, maximum-scale=1">
    <!-- #new -->

    <meta property="og:title" content="@if(isset($settings) && $settings['site_title']){{$settings['site_title']}}@endif" />
    <meta property="og:url" content="http://rentafilo.com" />
    <meta property="og:site_name" content="@if(isset($settings) && $settings['site_title']){{$settings['site_title']}}@endif" />
    <meta name="twitter:url" content="http://rentafilo.com" />
    <meta name="twitter:title" content="@if(isset($settings) && $settings['site_title']){{$settings['site_title']}}@endif" />
    <meta name="twitter:description" content="@if(isset($settings) && $settings['site_desc']){{$settings['site_desc']}}@endif" />
    <meta name="description" content="@if(isset($settings) && $settings['site_desc']){{$settings['site_desc']}}@endif">
    <meta name="keywords" content="@if(isset($settings) && $settings['site_keywords']){{$settings['site_keywords']}}@endif">

    <!-- css -->
    <link rel="stylesheet" href="/cssWeb/reset.css" />
    <link rel="stylesheet" href="/cssWeb/style.css" />
    <link rel="stylesheet" href="/cssWeb/font-awesome.min.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

</head>
<body>
<!-- header -->

<header>
    <div class="header">
        <div class="container-standart">
            <!-- logo -->
            <div class="logo">
                <a href="/">
                    <img src="/img/logo.png" alt="">
                </a>
            </div>
            <!-- new -->
            <div class="mobile-icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <!-- #new -->

            <!-- menü -->
            <div class="menu">
                <ul>
                    <li>
                        <a href="/">
                            Anasayfa
                        </a>
                    </li>
                    @foreach($mainMenu as $menu)
                    <li>
                        <a href="{{$menu['sef_link']}}">
                            {{ $menu['title'] }}
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="/iletisim">
                            İletişim
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer>
    <div class="footer-header">
        <div class="container-standart">
            <div class="footer-container" style="">
                <div class="footer-logo">
                    <a href="/"><img src="/img/logo.png" alt=""></a>
                </div>

                <div class="footer-desc">
                    @if(isset($settings) && $settings['contact_address'])<span><i class="fa fa-location-arrow"></i> <label>{{$settings['contact_address']}}</label></span>@endif
                    @if(isset($settings) && $settings['contact_cep'])<span><i class="fa fa-mobile"></i> <label>{{$settings['contact_cep']}}</label></span>@endif
                    @if(isset($settings) && $settings['contact_sabit'])<span><i class="fa fa-phone"></i> <label>{{$settings['contact_sabit']}}</label></span>@endif
                </div>
            </div>
        </div>
    </div>

    <!-- footer bottom -->

    <div class="footer-bottom">
        <div class="container-standart">
            <div class="brand-logo">
                <ul>
                    <li style="background:url('/img/brand/fiat.png'); background-size:cover; background-position:center center;"></li>
                    <li style="background:url('/img/brand/renault.png'); background-size:cover; background-position:center center;"></li>
                    <li style="background:url('/img/brand/mercedes.png'); background-size:cover; background-position:center center;"></li>
                    <li style="background:url('/img/brand/volkswagen.png'); background-size:cover; background-position:center center;"></li>
                    <li style="background:url('/img/brand/seat.png'); background-size:cover; background-position:center center;"></li>
                    <li style="background:url('/img/brand/peugeot.png'); background-size:cover; background-position:center center;"></li>
                </ul>
            </div>
            <div class="socail-links">
                <ul>
                    <li>
                        @if(isset($settings) && $settings['facebook'])
                            <a href="{{$settings['facebook']}}">
                                <i class="fa fa-facebook"></i>
                            </a>
                        @endif
                    </li>
                    <li>
                        @if(isset($settings) && $settings['twitter'])
                            <a href="{{$settings['twitter']}}">
                                <i class="fa fa-twitter"></i>
                            </a>
                        @endif
                    </li>
                    <li>
                        @if(isset($settings) && $settings['instagram'])
                            <a href="{{$settings['instagram']}}">
                                <i class="fa fa-instagram"></i>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- js -->

<script type="text/javascript" src="/jsWeb/jquery.js"></script>
<script type="text/javascript" src="/jsWeb/pSlider.min.js"></script>
<script type="text/javascript" src="/jsWeb/general.js"></script>
</body>
</html>
