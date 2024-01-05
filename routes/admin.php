<?php

use App\Http\Controllers\facturaController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\departamentoController;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\principalController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\ventaController;
use App\Models\producto;
use Illuminate\Support\Facades\Route;

Route::get('', [principalController::class, 'index']);
Route::get('/admin', [principalController::class, 'index']);
Route::prefix('/admin/cargo')->group(function () {
    Route::get('', [cargoController::class, 'index']);
    Route::get('/create', [cargoController::class, 'create']);
    Route::post('/insert', [cargoController::class, 'store']);
    Route::get('/read/{id}', [cargoController::class, 'show']);
    Route::get('/edit/{id}', [cargoController::class, 'edit']);
    Route::post('/update/{id}', [cargoController::class, 'update']);
    Route::get('/delete/{id}', [cargoController::class, 'destroy']);
});
Route::prefix('/admin/departamento')->group(function () {
    Route::get('', [departamentoController::class, 'index']);
    Route::get('/create', [departamentoController::class, 'create']);
    Route::post('/insert', [departamentoController::class, 'store']);
    Route::get('/read/{id}', [departamentoController::class, 'show']);
    Route::get('/edit/{id}', [departamentoController::class, 'edit']);
    Route::post('/update/{id}', [departamentoController::class, 'update']);
    Route::get('/delete/{id}', [departamentoController::class, 'destroy']);
});
Route::prefix('/admin/empleado')->group(function () {
    Route::get('', [empleadoController::class, 'index']);
    Route::get('/create', [empleadoController::class, 'create']);
    Route::post('/insert', [empleadoController::class, 'store']);
    Route::get('/read/{id}', [empleadoController::class, 'show']);
    Route::get('/edit/{id}', [empleadoController::class, 'edit']);
    Route::post('/update/{id}', [empleadoController::class, 'update']);
    Route::get('/delete/{id}', [empleadoController::class, 'destroy']);
});
Route::prefix('/admin/cliente')->group(function () {
    Route::get('', [clienteController::class, 'index']);
    Route::get('/create', [clienteController::class, 'create']);
    Route::post('/insert', [clienteController::class, 'store']);
    Route::get('/read/{id}', [clienteController::class, 'show']);
    Route::get('/edit/{id}', [clienteController::class, 'edit']);
    Route::post('/update/{id}', [clienteController::class, 'update']);
    Route::get('/delete/{id}', [clienteController::class, 'destroy']);
});
Route::prefix('/admin/producto')->group(function () {
    Route::get('', [productoController::class, 'index']);
    Route::get('/create', [productoController::class, 'create']);
    Route::post('/insert', [productoController::class, 'store']);
    Route::get('/read/{id}', [productoController::class, 'show']);
    Route::get('/edit/{id}', [productoController::class, 'edit']);
    Route::post('/update/{id}', [productoController::class, 'update']);
    Route::post('/disminuir/{id}', [productoController::class, 'disminuir']);
    Route::get('/delete/{id}', [productoController::class, 'destroy']);
});
Route::prefix('/admin/categoria')->group(function () {
    Route::get('', [categoriaController::class, 'index']);
    Route::get('/create', [categoriaController::class, 'create']);
    Route::post('/insert', [categoriaController::class, 'store']);
    Route::get('/read/{id}', [categoriaController::class, 'show']);
    Route::get('/edit/{id}', [categoriaController::class, 'edit']);
    Route::post('/update/{id}', [categoriaController::class, 'update']);
    Route::get('/delete/{id}', [categoriaController::class, 'destroy']);
});
Route::prefix('admin/venta')->group(function () {
    Route::get('', [ventaController::class, 'index']);
    Route::post('/insert', [ventaController::class, 'store']);
    Route::get('/insert/{id}', [ventaController::class, 'show']);
    Route::post('/update/detalle', [ventaController::class, 'update']);
});
Route::prefix('admin/factura')->group(function () {
    Route::get('', [facturaController::class, 'index']);
    Route::get('/show/{id}/generateInvoice', [facturaController::class, 'show'])->name('factura.invoice');
});

