@extends('layouts.app')

@section('template_title')
    503 | No disponible
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <strong>No disponible</strong>
                    </div>

                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset('images/error.jpg') }}" style="width: 60%;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr/>
                                <h5>El sistema no se encuentra disponible en estos momentos. Inténtelo más adelante o contacte
                                    con el administrador. Disculpe las molestias.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection