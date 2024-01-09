@extends('adminlte::page')


@section('title', 'Departamentos | Ver')

@section('content_header')
    <div>
        <h1>Ver Departamento</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <p>ID: {{ $departamentos->id }}</p>
            <p>Nombre del departamento: {{ $departamentos->nombre_departamento }}</p>

            <a href="{{ url('admin/departamento') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
