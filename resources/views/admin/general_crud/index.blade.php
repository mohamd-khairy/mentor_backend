@extends('adminlte::page')
@php 
    $keys = $data ? array_keys(($data->first()->toArray())) : [];
    $heads = $data ? $keys + ['label' => 'Actions'] : [];
       
    $config = [
        'data' => $data->map(function($q){ return array_values($q->toArray()); })->toArray(),
        'order' => [[1, 'asc']],
        'columns' => array_fill(0, count($keys), null),
    ];
@endphp

@section('title', $request_data['title'])

@section('content_header')


<div class="card-header">
    <h1 class="card-title">{{$request_data['title']}}</h1>

    <div class="card-tools">
        <a  href="{{route('admin.'.$request_data['route'].'.create')}}" class="btn btn-success text-right">
            {{__('adminlte::adminlte.create')}}
        </a>
    </div>
</div>


@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" with-buttons striped hoverable bordered compressed>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                @if($loop->first)
                @php $id = $cell; @endphp
                @endif

                <td>{!! $cell !!}</td>
                
                @if($loop->last)
                <td>
                <nobr>
                    <a class="btn btn-xs btn-default text-teal mx-1 shadow" href="{{route('admin.'.$request_data['route'].'.show' , $id)}}" title="Details">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>
                    <a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{route('admin.'.$request_data['route'].'.edit' , $id)}}" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    
                    <form action="{{route('admin.'.$request_data['route'].'.destroy' , $id)}}" method="post" onsubmit="return confirm('Are You Sure?');" style="display: inline-block;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" type="submit" href="#" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                </nobr>
                @endif
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop