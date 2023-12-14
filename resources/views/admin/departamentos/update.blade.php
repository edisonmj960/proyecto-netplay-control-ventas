@extends('adminlte::page')

@section('title', 'departamento | Editar')

@section('content_header')
    <div>
        <h1>Editar Departamento</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/distrito/update/'.$distritos->id.'') }}" method="POST">
                @csrf
                <x-adminlte-input name="nombre_distrito" value="{{ $distritos->nombre_distrito }}" label="Nombre del distrito" type="text" placeholder="Nombre del distrito"/>

                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary"/>
                <a href="{{ url('admin/distrito') }}" class="btn btn-danger btn-flat">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
