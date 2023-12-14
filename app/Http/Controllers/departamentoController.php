<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departamento;
class departamentoController extends Controller
{
    public function index()
    {
        $departamentos = departamento::all();
        return view('admin.departamentos.home', compact('departamentos'));
    }

    public function create()
    {
        return view('admin.departamentos.add');
    }

    public function store(Request $request)
    {
        $departamentos = new departamento();
        $departamentos->nombre_departamento = $request->nombre_departamento;
        try {
            $departamentos->save();
            return redirect('admin/departamento')->with('success', 'departamentos creado exitosamente');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Check for unique constraint violation
                return redirect('admin/departamento')->with('error', 'departamentos ya existe, no se puede crear');
            }
        }
        // return redirect('admin/departamentos');
    }

    public function show($id)
    {
        $departamentos = departamento::find($id);
        return view('admin.departamentos.read', compact('departamentos'));
    }

    public function edit($id)
    {
        $departamentos = departamento::find($id);
        return view('admin.departamentos.update', compact('departamentos'));
    }

    public function update(Request $request, $id)
    {
        $departamentos = departamento::find($id);
        $departamentos->nombre_departamento = $request->input('nombre_departamento');
        try {
            $departamentos->save();
            return redirect('admin/departamento')->with('success', 'departamentos actualizado exitosamente');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Check for unique constraint violation
                return redirect('admin/departamento')->with('error', 'departamentos ya existe, no se puede actualizar');
            }
        }
    }

}
