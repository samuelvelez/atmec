<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title')
        | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
    <meta name="description" content="">
    <link rel="shortcut icon" href="/favicon.ico">


    <meta name="google-site-verification" content="2LHQ9FhmPNIiLZ_e2hjMDRVYwLhhqsdKReqr1dk-NcE" />

    {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- Fonts --}}
    @yield('template_linked_fonts')

    {{-- Styles --}}
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    @yield('template_linked_css')

    <style type="text/css">
        @yield('template_fastload_css')

            @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
                .user-avatar-nav {
            background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
            background-size: auto 100%;
        }
        @endif

    </style>

    {{-- Scripts --}}
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>

    @if (Auth::User() && (Auth::User()->profile) && $theme->link != null && $theme->link != 'null')
        <link rel="stylesheet" type="text/css" href="{{ $theme->link }}">
    @endif

    @yield('head')

</head>
<body>
<div id="app">

    @auth
        @include('partials.nav')
    @endauth

    @guest
        <div class="row text-center">
            <div class="col-12 mt-4">
                <img src="{{asset('images/atm.png')}}">
            </div>
        </div>
    @endguest

    <main class="py-4">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('partials.form-status')
                </div>
            </div>
        </div>

        @yield('content')

        <footer class="page-footer font-small blue pt-4">
            <div class="container-fluid text-center text-md-left">
                <div class="footer-copyright text-center py-3">© 2019 Copyright:
                    <a href="https://www.atm.gob.ec/"> ATM</a>
                </div>
            </div>
        </footer>
    </main>
</div>

{{-- Scripts --}}
<script src="{{ mix('/js/app.js') }}"></script>
@if(true)//config('settings.googleMapsAPIStatus')) '.config("settings.googleMapsAPIKey").'
    {!! HTML::script('//maps.googleapis.com/maps/api/js?key=AIzaSyDYpfb7OTFs4oHrrNgLPl9qefqOdjjzLxE&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
    
@endif

@yield('footer_scripts')

</body>
</html>
