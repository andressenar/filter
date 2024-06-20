<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

/* Rutas para el administrador */
Route::get('/admin/panel', [AdminController::class, 'showAdminPanel'])->name('admin.panel');
Route::post('/admin/categorias/crear', [AdminController::class, 'createCategory'])->name('admin.createCategory');


/* Rutas para el cliente */
Route::get('/menu', [CustomerController::class, 'showMenu'])->name('customer.menu');
Route::post('/orden/crear', [CustomerController::class, 'createOrder'])->name('customer.createOrder');



