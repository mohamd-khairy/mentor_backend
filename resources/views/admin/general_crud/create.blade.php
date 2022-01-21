@extends('adminlte::page')

@php 
@endphp

@section('title', $request_data['title'])

@section('content_header')
    <h1>{{$request_data['title']}}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{__('adminlte::adminlte.create')}}</h3>
    </div>
    <div class="card-body">
        
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop