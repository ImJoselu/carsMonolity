@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('403 - Forbidden') }}</div>

                <div class="card-body">
                    <p>{{ __('No estas autorizado para acceder!.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

