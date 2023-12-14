<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleado;
use App\Models\departamento;
use App\Models\cargo;

class empleadoController extends Controller
{
    public function index()
    {
        $empleados = empleado::all();
        $departamento = departamento::all();
        $cargo = cargo::all();
        //que remplace el id_departamento y el cod_cargo por departamento y cargo
        $empleados = $empleados->map(function ($empleado) use ($departamento, $cargo) {
            $empleado->id_departamento = $departamento->find($empleado->id_departamento)->nombre_departamento;
            $empleado->cod_cargo = $cargo->find($empleado->cod_cargo)->nombre_cargo;
            return $empleado;
        });
        return view('admin.empleados.home', compact('empleados', 'departamento', 'cargo'));
    }

    public function create()
    {
        $departamento = departamento::all();
        $cargo = cargo::all();
        return view('admin.empleados.add', compact('departamento', 'cargo'));
    }

    public function store(Request $request)
    {
        $empleado = new empleado();
        $empleado->nombres = $request->input('nombres');
        $empleado->apellidos = $request->input('apellidos');
        $empleado->dni_empleado = $request->input('dni_empleado');
        $empleado->direccion = $request->input('direccion');
        $empleado->estado_civil = $request->input('estado_civil');
        $empleado->nivel_educacion = $request->input('nivel_educacion');
        $empleado->telefono = $request->input('telefono');
        $empleado->email = $request->input('email');
        $empleado->sueldo_basico = $request->input('sueldo_basico');
        $empleado->fecha_ingreso = $request->input('fecha_ingreso');
        $empleado->id_departamento = $request->input('id_departamento');
        $empleado->cod_cargo = $request->input('cod_cargo');
        try {
            $empleado->save();
            return redirect('admin/empleado')->with('success', 'empleado creado exitosamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/empleado')->with('error', 'no se puede crear el empleado');
        }
    }

    public function show($id)
    {
        $departamento = departamento::all();
        $cargo = cargo::all();
        $empleado = empleado::find($id);
        return view('admin.empleados.read', compact('empleado', 'departamento', 'cargo'));
    }

    public function edit($id)
    {
        $empleados = empleado::find($id);
        $departamento = departamento::all();
        $cargo = cargo::all();
        return view('admin.empleados.update', compact('empleados', 'departamento', 'cargo'));
    }

    public function update(Request $request, $id)
    {
        $empleados = empleado::find($id);
        $empleados->nombres = $request->input('nombres');
        $empleados->apellidos = $request->input('apellidos');
        $empleados->dni_empleado = $request->input('dni_empleado');
        $empleados->direccion = $request->input('direccion');
        $empleados->estado_civil = $request->input('estado_civil');
        $empleados->nivel_educacion = $request->input('nivel_educacion');
        $empleados->telefono = $request->input('telefono');
        $empleados->email = $request->input('email');
        $empleados->sueldo_basico = $request->input('sueldo_basico');
        $empleados->fecha_ingreso = $request->input('fecha_ingreso');
        $empleados->id_departamento = $request->input('id_departamento');
        $empleados->cod_cargo = $request->input('cod_cargo');
        try {
            $empleados->save();
            return redirect('admin/empleado')->with('success', 'empleado actualizado exitosamente');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/empleado')->with('error', 'no se puede actualizar el empleado');
        }
    }

    public function destroy($id)
    {
    }
}
