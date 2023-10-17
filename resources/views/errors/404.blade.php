@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Error 404: Página no encontrada') }}</div>

                    <div class="card-body">
                        <p>{{ __('Lo siento, la página que estás buscando no existe.') }}</p>
                        <a href="/" class="btn btn-primary">{{ __('Ir a la página de inicio') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
