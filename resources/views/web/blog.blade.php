@extends('web.layouts.app')
@section('pagetitle', 'Blog')
@section('content')
    <main>
        <div class="page-title">
            <div class="container-flex">
                <div class="page-cover" style="background:url('/img/page-bg.jpg'); background-size:cover; background-position:center center;">
                    <div class="page-cover-bg">
                        <div class="container-standart">
                            <h3>Blog</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">
            <div class="container-standart">
                <div class="blog-list">
                    <ul>
                        @if(isset($posts))
                            @foreach($posts as $post)
                                <li>
                                    <div class="blog-list-image" style="background-image:url('@if(isset($post) && $post['img']){{$post['img']}}@endif'); background-position:center center; background-size:cover"></div>
                                    <a href="@if(isset($post) && $post['sef_link']){{$post['sef_link']}}@endif"><h5>@if(isset($post) && $post['title']){{$post['title']}}@endif</h5> <span>{{substr($post['created_at'],0,10)}}</span></a>
                                    <p>
                                        @if(isset($post) && $post['content']){!! substr($post['content'],0,150) !!}@endif
                                    </p>
                                </li>
                            @endforeach
                        @else
                        Blog da yazı içeriği bulunmamaktadır.
                        @endif
                    </ul>
                </div>


                <div class="blog-list-pagination">
                    <ul>
                        {{$posts->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection