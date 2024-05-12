<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//  indice-generico
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index'); // lleva al template wellcome.blade.php, pero le pasamos una variable que es un array
//  pruebas
Route::get('/home/', function() { return 'Hola, mundo'; }); //a la pagina /home le pasamos que escriba hola mundo
Route::get('/prueba/', function() { return view('prueba'); }); // lleva al template prueba.blade.php
//Route::get('/mostrar-prueba/{mensaje}', function() { $mensaje = 'Hola desde el controlador!'; return view('prueba2', ['mensaje' => $mensaje]);}); // si hay esa variable escribe 'Hola desde el controlador'
Route::get('/mostrar-prueba/{mensaje}/{mensaje2?}', [GreetingsController::class, 'hello'])->name('hello'); // si hay esa variable escribe 'Hola desde el controlador'
Route::get('/vista/', [GreetingsController::class, 'vista'])->name('vista'); // si hay esa variable escribe 'Hola desde el controlador'
Route::get('/mostrar-prueba2/{mensaje}', function($mensaje) { return view('prueba2', ['mensaje' => $mensaje]);}); // pasar una variable a la vista
//*******************************************************************************************************
//  maestro-detalles
// CLIENTS
Route::get('/clientes/', [ClientController::class, 'list'])->name('clients.list'); // lleva al template wellcome.blade.php, pero le pasamos una variable que es un array
Route::get('/clientes/{client}/', [ClientController::class, 'get'])->name('clients.get');
Route::post('/clientes/nuevo/', [ClientController::class, 'add'])->name('clients.add');
Route::put('/clientes/{client}/actualizar/', [ClientController::class, 'edit'])->name('clients.edit');
Route::delete('/clientes/{client}/eliminar/', [ClientController::class, 'delete'])->name('clients.delete');

// SELLERS
Route::get('/vendedores/', [SellerController::class, 'list'])->name('sellers.list'); // lleva al template wellcome.blade.php, pero le pasamos una variable que es un array
Route::get('/vendedores/{seller}', [SellerController::class, 'get'])->name('sellers.get');
Route::post('/vendedores/nuevo/', [SellerController::class, 'add'])->name('sellers.add');
Route::put('/vendedores/{seller}/actualizar/', [SellerController::class, 'edit'])->name('sellers.edit');
Route::delete('/vendedores/{seller}/eliminar/', [SellerController::class, 'delete'])->name('sellers.delete');

// VEHICLES
Route::get('/vehiculos/', [VehicleController::class, 'list'])->name('vehicles.list'); // lleva al template wellcome.blade.php, pero le pasamos una variable que es un array
Route::get('/vehiculos/busqueda', [VehicleController::class, 'search'])->name('vehicles.search'); // lleva al template wellcome.blade.php, pero le pasamos una variable que es un array
Route::get('/vehiculos/{vehicle}', [VehicleController::class, 'get'])->name('vehicles.get');
Route::post('/vehiculos/nuevo/', [VehicleController::class, 'add'])->name('vehicles.add');
Route::put('/vehiculos/{vehicle}/actualizar/', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::delete('/vehiculos/{vehicle}/eliminar/', [VehicleController::class, 'delete'])->name('vehicles.delete');

//al hacer el post tanto si pongo nuevo como si no, no pasa nada, no? en una url puede haver un get, un post, un delete
// o puede darse a confucsion si utilizo Route::get('/vehiculos/', y Route::post('/vehiculos/', ?

