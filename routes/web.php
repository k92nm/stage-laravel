<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;

Route::get('/', function () {
    return view('welcome');
});

//Pour afficher le formulaire de creation d'un client
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

//Route pour recevoir les données du formulaire
Route::post('clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::get('/clients/{client}', [App\Http\Controllers\ClientController::class, 'show'])->name('clients.show');
Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');