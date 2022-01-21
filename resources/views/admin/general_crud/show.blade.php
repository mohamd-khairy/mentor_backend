@extends('adminlte::page')
@php 
    $keys = $data ? array_keys(($data->first()->toArray())) : [];
@endphp

@section('title', $request_data['title'])

@section('content_header')
    <h1>{{$request_data['title']}}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{__('adminlte::adminlte.show')}}</h3>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>{{__('adminlte::adminlte.key')}}</th>
                    <th>{{__('adminlte::adminlte.value')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keys as $k)
                <tr>
                    <td>{{$k ?? '-'}}</td>
                    <td>{{$data->$k ?? '-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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