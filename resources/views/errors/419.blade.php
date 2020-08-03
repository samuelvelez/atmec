@extends('layouts.app')

@section('template_title')
    419 | Sesión expirada
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <strong>Sesión expirada</strong>
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
                                <h5>Su sesión de trabajo expiró. Recargue el formulario enviado o inicie sesión nuevamente.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection