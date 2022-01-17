@extends('adminlte::page')
@php 
    $fillable = $request_data['model']->getfillableTypes() ? $request_data['model']->getfillableTypes() : [];
    $keys = $data ? array_keys(($data->toArray()[0])) : [];
    $heads = $data ? $keys + ['label' => 'Actions'] : [];

    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </button>';
    $config = [
        'data' => $data->map(function($q){ return array_values($q->toArray()); })->toArray(),
        'order' => [[1, 'asc']],
        'columns' => array_fill(0, count($keys), null),
      
    ];
@endphp

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$request_data['title']}}</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable bordered compressed>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
                @if($loop->last)
                <td>{!! '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>' !!}</td>
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