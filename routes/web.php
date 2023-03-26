<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Categoria;
use App\Models\Producte;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirecciona la ruta raíz a la lista de todos los productos
Route::get('/', function () {
    return redirect('/producte/tots');
});

// Muestra una lista de todos los productos
Route::get('/producte/tots', [ProducteController::class, 'veureTots']);

// Muestra un producto individual
Route::get('/producte/{id}/veure', [ProducteController::class, 'veure']);

// Muestra una lista de productos de una categoría específica
Route::get('/categoria/{id}/productes', [CategoriaController::class, 'veureProductes']);

// Ruta protegida que solo se puede acceder si el usuario ha iniciado sesión y verificado su cuenta
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas que solo se pueden acceder si el usuario ha iniciado sesión
Route::middleware('auth')->group(function () {
    // Muestra la lista de productos en la cesta de la compra del usuario
    Route::get('/producte/cesta', [ProducteController::class, 'veureCesta']);

    // Rutas para editar, actualizar y eliminar el perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para crear, leer, actualizar y eliminar categorías de productos
    Route::resource('/categoria', CategoriaController::class);

    

    // Rutas para crear, leer, actualizar y eliminar productos
    Route::resource('/producte', ProducteController::class);

    Route::post('/producte/{id}/opinio', [ProducteController::class, 'afegirOpinio']);

    // Rutas para agregar, actualizar y eliminar productos de la cesta de la compra del usuario
    Route::post('/producte/{id}/cesta', [ProducteController::class, 'afegirCesta']);
    Route::put('/producte/{id}/cesta', [ProducteController::class, 'actualitzarCesta']);
    Route::delete('/producte/{id}/cesta', [ProducteController::class, 'treureCesta']);

    // Ruta para comprar los productos en la cesta del usuario
    Route::post('/comprar', [ProducteController::class, 'comprarCesta']);

    // Rutas para crear, leer, actualizar y eliminar cuentas de
    
    
    
    
     
    
    Route::resource('/compte', CompteController::class);

    // Rutas para crear, leer, actualizar y eliminar usuarios
    Route::resource('/usuari', UserController::class);

    // Ruta para actualizar la contraseña de un usuario
    Route::put('/usuari/{id}/password', [UserController::class, 'update_pass']);

});
require __DIR__.'/auth.php';
