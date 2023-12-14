<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\producto;
use App\Models\cliente;
use App\Models\detalleFactura;
use App\Models\empleado;

class ventaController extends Controller
{
    public function index()
    {
        $factura = factura::all();
        $producto = producto::all();
        $cliente = cliente::all();
        $empleado = empleado::all();
        return view('admin.venta.home', compact('factura', 'producto', 'cliente', 'empleado'));
    }

    public function store(Request $request)
    {
        $factura = new factura();
        $factura->fecha_emision = new \DateTime();
        $factura->estado_factura = true;
        $factura->cliente_id = $request->input('id_cliente');
        $factura->cod_empleado = $request->input('cod_emple');
        try{
            $factura->save();
            $id_factura = $factura->id;
            $factura = factura::find($id_factura);
            return redirect('admin/venta/insert/'.$factura->id.'')->with('success', 'factura creada exitosamente');
        }catch(\Exception $e){
            return redirect('admin/venta')->with('error', 'No se pudo crear la factura');
        }

    }
    public function show($id)
    {
        $producto = producto::all();
        $cliente = cliente::all();
        $empleado = empleado::all();
        $factura = factura::find($id);
        $detalleFactura = detalleFactura::where('num_factura', $factura->id)->get();
        return view('admin.venta.update', compact('factura', 'producto', 'cliente', 'empleado', 'detalleFactura'));
    }
    public function update(Request $request)
    {
        $detalleFactura = new detalleFactura();
        $detalleFactura->num_factura = $request->input('num_factura');
        $detalleFactura->id_prod = $request->input('id_prod');
        $detalleFactura->cantidad = $request->input('cantidad');
        $detalleFactura->precio = $request->input('precio');
        $detalleFactura->save();
    }

}
