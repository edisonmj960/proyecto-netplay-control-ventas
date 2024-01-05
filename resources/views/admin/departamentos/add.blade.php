@extends('adminlte::page')

@section('title', 'departamentos | Crear')

@section('content_header')
    <div>
        <h1>Crear departamento</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/departamento/insert') }}" method="POST">
                @csrf
                <x-adminlte-input name="nombre_departamento" label="Nombre del departamento" type="text" placeholder="Nombre del departamento"/>

                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary"/>
                <x-adminlte-button class="btn-flat" href="{{ url('admin/departamento') }}" label="Cancelar" theme="danger" />
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
