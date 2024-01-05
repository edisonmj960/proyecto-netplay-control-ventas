@extends('adminlte::page')

@section('title', 'departamentos | Editar')

@section('content_header')
    <div>
        <h1>Editar departamento</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/departamento/update/'.$departamentos->id.'') }}" method="POST">
                @csrf
                <x-adminlte-input name="nombre_departamento" value="{{ $departamentos->nombre_departamento }}" label="Nombre del departamento" type="text" placeholder="Nombre del departamento"/>

                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary"/>
                <a href="{{ url('admin/departamento') }}" class="btn btn-danger btn-flat">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
