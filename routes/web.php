<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/', [CocheController::class, 'welcome']);
Route::get('/coches', [CocheController::class, 'index']);
Route::get('/coches/create',  [CocheController::class, 'create']);
Route::get('/coches/filtro', [CocheController::class, 'filtro'])->name('coches.filtro');
Route::post('/coches',  [CocheController::class, 'store']);
Route::get('/coches/{coche}', [CocheController::class, 'show'])->name('coches.show');
Route::get('/coches/{coche}/edit', [CocheController::class, 'edit'])->name('coches.edit');
Route::put('/coches/{coche}',  [CocheController::class, 'update']);
Route::delete('/coches/{coche}', [CocheController::class, 'destroy'])->name('coches.destroy');
Route::post('/coches/{coche}/comprar', [CocheController::class, 'comprar'])->name('coches.comprar');

Route::get('/login', [LoginController::class, 'getLogin']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/registro',  [UsuarioController::class, 'create']);
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios',  [UsuarioController::class, 'store']);
Route::get('/usuarios/create',  [UsuarioController::class, 'create'])->name('usuarios.create');
Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::get('/usuarios/{usuario}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::put('/usuarios/{usuario}',  [UsuarioController::class, 'update']);
Route::post('/check-email', [UsuarioController::class, 'checkEmailExists']);
Route::get('/eliminados', [UsuarioController::class, 'eliminados'])->name('usuarios.eliminados');
Route::post('/usuarios/{id}/restaurar', [UsuarioController::class, 'restaurarUsuario'])->name('usuarios.restaurar');
Route::get('/panelAdmin', [UsuarioController::class, 'panelAdmin'])->name('panelAdmin');

Route::get('/marcas/create',  [MarcaController::class, 'create']);
Route::post('/marcas',  [MarcaController::class, 'store']);

Route::get('/blog',  [BlogController::class, 'index']);

