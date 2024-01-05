@extends('adminlte::page')

@section('title', 'Facturas')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Facturas</h1>
    </div>
@stop

@section('content')
    @php
        $heads = ['ID', 'Fecha', 'Estado', 'Cliente', 'Empleado', 'Ver Factura'];

        $data = $facturas->toArray();
        $data = array_map(function ($row) {
            $row[3] =
                $row['estado_factura'] == 'Pagada'
                    ? '<nobr>' .
                        '<a href="factura/show/' .
                        $row['id'] .
                        '/generateInvoice" target="_blank">
            Ver Detalle de Factura
        </a>' .
                        '</nobr>'
                    : '<nobr>' . '<span class="text-danger">No Existe Detalle</span>' . '</nobr>';
            return $row;
        }, $data);
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, ['orderable' => false]],
        ];
    @endphp
    <x-adminlte-datatable id="table1" head-theme="dark" :heads="$heads" striped hoverable bordered>
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
@stop

@section('js')
@stop
