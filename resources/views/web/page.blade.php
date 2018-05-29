@extends('web.layouts.app')
@section('pagetitle', $page['title'])
@section('content')
    <main>
        <div class="page-title">
            <div class="container-flex">
                <div class="page-cover" style="background:url('/img/page-bg.jpg'); background-size:cover; background-position:center center;">
                    <div class="page-cover-bg">
                        <div class="container-standart">
                            <h3>@if(isset($page) && $page['title']){{$page['title']}}@endif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">
            <div class="container-standart">
                <div class="page-container-left">
                    <div class="page-container-left-menu">
                        <ul>
                            <li>
                                <a href="/">
                                    Ana Sayfa
                                </a>
                            </li>
                            @foreach($sideMenu as $menu)
                                <li>
                                    <a href="{{$menu['sef_link']}}">
                                        {{ $menu['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="page-container-right">
                    <div class="page-container-content">
                        @if(isset($page) && $page['content']){!! $page['content'] !!}@endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection