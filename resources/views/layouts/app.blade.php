<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{config('app.name')}}</title>

        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext"> --}}
    
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> 
        <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

        @yield('styles')
        <script src="{{asset('js/fonst.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        
        {{-- Summernote --}}
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="">
        <div id='app'>
            <div class="page">
                <div class="page-main">
                    <div class="flex-fill">
                        @include('elements.header')
                        <div class="my-3 my-md-5">
                            <div class="container">
                                <!-- Page title -->
                                <div class="page-header">
                                    {{ $header }}
                                </div>
                                @if (Session::has('message'))
                                    <div class="alert alert-{{Session::get('message')['type']}} alert-dismissible fade show" role="alert">
                                        {{Session::get('message')['text']}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                {{ $content }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{ $scripts }}
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    {{-- Summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/lang/summernote-es-ES.js"></script>
</html>