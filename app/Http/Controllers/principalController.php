<?php

namespace App\Http\Controllers;

use App\Models\factura;
use App\Models\cargo;
use App\Models\categoria;
use App\Models\cliente;
use App\Models\departamento;
use App\Models\empleado;
use App\Models\producto;
use Illuminate\Http\Request;

class principalController extends Controller
{
    public function index()
    {
        $facturas = factura::all();
        $empleados = empleado::all();
        $empleado = empleado::all();
        $cliente = cliente::all();

        $categoria = categoria::all();
        $cargo = cargo::all();
        $departamento = departamento::all();
        $productos = producto::all();

        //  Inicializar un array para almacenar el número de facturas por empleado
        $facturasPorEmpleado = [];

        //  Inicializar el array con todos los empleados y establecer el número de facturas en 0
        foreach ($empleado as $empleado) {
            $facturasPorEmpleado[$empleado->id] = 0;
        }

        //Contar el número de facturas por empleado
        foreach ($facturas as $factura) {
            $facturasPorEmpleado[$factura->cod_empleado]++;
        }

        return view('index', compact('facturas','empleados', 'empleado', 'cliente', 'categoria', 'cargo', 'departamento', 'empleado', 'productos', 'facturasPorEmpleado'));
    }
}
