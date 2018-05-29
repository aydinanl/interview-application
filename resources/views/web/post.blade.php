@extends('web.layouts.app')
@section('pagetitle', $post['title'])
@section('content')

    <main>
        <div class="page-title">
            <div class="container-flex">
                <div class="page-cover" style="background:url('@if(isset($post) && $post['img']){{$post['img']}}@else /img/page-bg.jpg @endif/'); background-size:cover; background-position:center center;">
                    <div class="page-cover-bg">
                        <div class="container-standart">
                            <h3>@if(isset($post) && $post['title']){{$post['title']}}@endif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">
            <div class="container-standart">
                <div class="blog-content">
                    <h5 class="blog-sub-title">@if(isset($post) && $post['title']){!! $post['title'] !!}@endif  <span>{{substr($post['created_at'],0,10)}}</span></h5>
                    <p>
                        @if(isset($post) && $post['content']){!! $post['content'] !!}@endif
                    </p>

                    <div class="blog-content-tag">
                        <a href="#">Etiketler :</a>
                        @foreach($tags as $tag)
                            <a href="{{$tag['sef_link']}}">{{$tag['name']}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection