@extends('web.layouts.app')
@section('pagetitle', 'İletişim')
@section('content')

    <main>
        <div class="page-title">
            <div class="container-flex">
                <div class="page-cover" style="background:url('/img/page-bg.jpg'); background-size:cover; background-position:center center;">
                    <div class="page-cover-bg">
                        <div class="container-standart">
                            <h3>İletişim</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">
            <div class="container-standart">
                <div class="page-contact">
                    <form action="/iletisim/save" method="post">
                        @if(isset($error) && isset($error['message']))
                            <p style="color: red">{{$error['message']}}</p>
                        @endif
                        @if(isset($success) && isset($success['message']))
                            <p style="color: #4caf50">{{$success['message']}}</p>
                        @endif
                        <div class="form-group">
                            <span>Ad</span>
                            <input type="text" name="isim">
                        </div>
                        <div class="form-group">
                            <span>Soyad</span>
                            <input type="text" name="soyad">
                        </div>

                        <div class="form-group">
                            <span>Email</span>
                            <input type="text" name="email">
                        </div>

                        <div class="form-group">
                            <span>Telefon</span>
                            <input type="text" name="telefon" value="">
                        </div>

                        <div class="form-group">
                            <span>Mesaj</span>
                            <textarea name="icerik" ></textarea>
                        </div>

                        <div class="form-group">
                            <span></span>
                            <button type="submit">Gönder</button>
                        </div>
                    </form>
                </div>

                <div class="page-information" style="margin-bottom: 20px">
                    <h5>Adresimiz</h5>

                    <span>@if(isset($settings) && $settings['contact_address'])<span><i class="fa fa-location-arrow"></i> <label>{{$settings['contact_address']}}</label></span>@endif</span>
                    <h5>Telefon</h5>
                    <span>@if(isset($settings) && $settings['contact_cep'])<span><i class="fa fa-mobile"></i> <label>{{$settings['contact_cep']}}</label></span>@endif</span>
                    <span>@if(isset($settings) && $settings['contact_map'])<span><i class="fa fa-phone"></i> <label>{{$settings['contact_sabit']}}</label></span>@endif</span>
                </div>
                @if(isset($settings) && $settings['contact_branch_address'])
                    <div class="page-information">
                        <h5>Şube Adresimiz</h5>

                        <span>@if(isset($settings) && $settings['contact_branch_address'])<span><i class="fa fa-location-arrow"></i> <label>{{$settings['contact_branch_address']}}</label></span>@endif</span>
                        <h5>Telefon</h5>
                        <span>@if(isset($settings) && $settings['contact_branch_cep'])<span><i class="fa fa-mobile"></i> <label>{{$settings['contact_branch_cep']}}</label></span>@endif</span>
                        <span>@if(isset($settings) && $settings['contact_branch_sabit'])<span><i class="fa fa-phone"></i> <label>{{$settings['contact_branch_sabit']}}</label></span>@endif</span>
                    </div>
                @endif
            </div>
        </div>

        @if(isset($settings) && $settings['contact_map']){!! $settings['contact_map'] !!}}@endif


    </main>

@endsection