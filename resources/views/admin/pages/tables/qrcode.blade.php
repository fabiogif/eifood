@extends('adminlte::page')

@section('title', 'QrCode')

@section('content_header')
    <h1 class="m-0 text-dark">QrCode</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="visible-print">
                {!! QrCode::size(300)->generate($uri) !!}
            </div>
            <span>{{ $uri }}</span>
        </div>
        <!--card-body-->
    </div>
    <!--card-->
@endsection
