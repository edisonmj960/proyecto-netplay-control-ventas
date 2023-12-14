<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\departamento;

class clienteController extends Controller
{
    public function index()
    {
        $departamento = departamento::all();
        $cliente = cliente::all();
        $cliente = $cliente->map(function ($cliente) use ($departamento) {
            $cliente->id_departamento = $departamento->find($cliente->id_departamento)->nombre_departamento;
            return $cliente;
        });
        return view('admin.clientes.home', compact('cliente'));
    }

    public function create()
    {
        $departamento = departamento::all();
        return view('admin.clientes.add', compact('departamento'));
    }

    public function store(Request $request)
    {
        $cliente = new cliente();
        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->id_departamento = $request->input('id_departamento');
        try {
            $cliente->save();
            return redirect('admin/cliente')->with('success', 'cliente creado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/cliente')->with('error', 'no se puede crear el cliente');
        }
    }

    public function show($id)
    {
        $departamento = departamento::all();
        $cliente = cliente::find($id);
        return view('admin.clientes.read', compact('cliente', 'departamento'));
    }

    public function edit($id)
    {
        $cliente = cliente::find($id);
        $departamento = departamento::all();
        return view('admin.clientes.update', compact('cliente', 'departamento'));
    }

    public function update(Request $request, $id)
    {
        $cliente = cliente::find($id);
        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->id_departamento = $request->input('id_departamento');
        try{
        $cliente->save();
        return redirect('admin/cliente')->with('success', 'cliente actualizado correctamente');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/cliente')->with('error', 'no se puede actualizar el cliente');
        }
    }

    public function destroy($id)
    {
    }
}
