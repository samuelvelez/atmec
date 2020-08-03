@extends('layouts.app')

@section('template_title')
    Bienvenido {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('images/atm.png') }}">
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    </div>

@endsection
