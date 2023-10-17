@extends('layout')
@section('content')
    <div id="tableroBlogs">
        @foreach ($blogs as $blog)
            @if ($blog->tipo == 1)
                <div class="card text-white bg-primary mb-3" style="width: 300px; height: 150px;">
                    <div class="card-header">{{ $blog->publicada }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->titulo }}</h5>
                        <p class="card-text">{{ $blog->mensaje }}</p>
                    </div>
                </div>
            @elseif ($blog->tipo == 2)
                <div class="card text-white bg-success mb-3" style="width: 300px; height: 150px;">
                    <div class="card-header">{{ $blog->publicada }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->titulo }}</h5>
                        <p class="card-text">{{ $blog->mensaje }}</p>
                    </div>
                </div>
            @else
                <div class="card text-white bg-danger mb-3" style="width: 300px; height: 150px;">
                    <div class="card-header">{{ $blog->publicada }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->titulo }}</h5>
                        <p class="card-text">{{ $blog->mensaje }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
