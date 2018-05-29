@extends('web.layouts.app')
@section('pagetitle', 'Tag')
@section('content')
    <main>
        <div class="page-title">
            <div class="container-flex">
                <div class="page-cover" style="background:url('http://startuptipsdaily.com/wp-content/uploads/2017/02/business-meeting.jpg'); background-size:cover; background-position:center center;">
                    <div class="page-cover-bg">
                        <div class="container-standart">
                            <h3>Etiket</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">
            <div class="container-standart">
                <div class="blog-list">
                    <ul>
                        @if(isset($tagPosts))
                            @foreach($tagPosts as $tagPost)
                                <li>
                                    <div class="blog-list-image" style="background-image:url('@if(isset($tagPost) && $tagPost['img']){{$tagPost['img']}}@endif'); background-position:center center; background-size:cover"></div>
                                    <a href="@if(isset($tagPost) && $tagPost['sef_link']){{$tagPost['sef_link']}}@endif"><h5>@if(isset($tagPost) && $tagPost['title']){{$tagPost['title']}}@endif</h5> <span>{{substr($tagPost['created_at'],0,10)}}</span></a>
                                    <p>
                                        @if(isset($tagPost) && $tagPost['content']){!! substr($tagPost['content'],0,150) !!}@endif
                                    </p>
                                </li>
                            @endforeach
                        @else
                            Blog da yazı içeriği bulunmamaktadır.
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </main>
@endsection