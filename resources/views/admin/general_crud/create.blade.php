@extends('adminlte::page')

@php
@endphp

@section('title', $request_data['title'])

@section('content_header')
<h1>{{$request_data['title']}}</h1>
@stop

@section('content')

<div class="card">
    <form method="post" action="{{route('admin.'.$request_data['route'].'.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-header">
            <h3 class="card-title">{{__('adminlte::adminlte.create')}}</h3>
        </div>
        <div class="card-body">
                @foreach($request_data['model']->create as $type => $item)
                    @if($item)
                        @foreach($item as $k => $v)
                            @if($type == 'input')
                                @include('admin.forms.input' , $v)
                            @elseif($type == 'select')
                                @include('admin.forms.select' , $v + ['relations' => $data])
                            @elseif($type == 'image')
                                @include('admin.forms.image' , $v)
                            @endif
                        @endforeach
                    @endif
                @endforeach
            
        </div>
        <div class="card-header">
            <button class="btn btn-success" type="submit">{{__('adminlte::adminlte.create')}}</button>
        </div>
    </form>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop