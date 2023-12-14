<?php

namespace App\Http\Controllers;

use App\Models\factura;
use App\Models\cliente;
use App\Models\detallefactura;
use App\Models\empleado;
use App\Models\producto;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class facturaController extends Controller
{
    public function index()
    {
        $facturas = factura::all();
        $clientes = cliente::all();
        $empleado = empleado::all();
        $detalle = detallefactura::all();
        $facturas = $facturas->map(function ($facturas) use ($clientes, $empleado) {
            //$facturas->estado_factura = $facturas->estado_factura ? 'Pagada' : 'Pendiente';
            $facturas->cliente_id = $clientes->find($facturas->cliente_id)->nombres . ' ' . $clientes->find($facturas->cliente_id)->apellidos;
            $facturas->cod_empleado = $empleado->find($facturas->cod_empleado)->nombres . ' ' . $empleado->find($facturas->cod_empleado)->apellidos;

            // Verificar si hay detalles para la factura
            $detallesCount = Detallefactura::where('num_factura', $facturas->id)->count();

            // Agregar propiedad anulado según la cantidad de detalles
            $facturas->estado_factura = $detallesCount == 0 ? 'Anulada' : 'Pagada';
            return $facturas;
        });
        return view('admin.facturas.home', compact('facturas'));
    }

    public function show($id)
    {
        $factura = factura::find($id);
        $clientes = cliente::all();
        $empleado = empleado::all();
        $productos = producto::all();
        $detalle = detallefactura::where('num_factura', $factura->id)->get();

        $customer = new Buyer([
            'name'          => $clientes->find($factura->cliente_id)->nombres . ' ' . $clientes->find($factura->cliente_id)->apellidos,
            'custom_fields' => [
                'email' => $clientes->find($factura->cliente_id)->email,
            ],
        ]);

        $seller = new Buyer([
            'name'          => $empleado->find($factura->cod_empleado)->nombres . ' ' . $empleado->find($factura->cod_empleado)->apellidos,
            'custom_fields' => [
                'email' => $empleado->find($factura->cod_empleado)->email,
            ],
        ]);

        $items = [];

        foreach ($detalle as $value) {
            $product = $productos->find($value->id_prod);

            $items[] = (new InvoiceItem())
                ->title($product->descripcion)
                ->pricePerUnit($value->precio)
                ->quantity($value->cantidad);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->addItems($items)
            ->serialNumberFormat($id)
            ->taxRate(0) // Ajusta el porcentaje de impuestos según tu lógica
            ->currencySymbol('S/') // Símbolo de moneda
            ->currencyCode('PEN'); // Código de moneda

        return $invoice->stream();
    }
}
