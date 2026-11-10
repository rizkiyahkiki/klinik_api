<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\DokterController;

// API Pasien
Route::get('/pasiens', [PasienController::class, 'index']);
Route::post('/pasiens', [PasienController::class, 'store']);
Route::get('/pasiens/{id}', [PasienController::class, 'show']);
Route::put('/pasiens/{id}', [PasienController::class, 'update']);
Route::delete('/pasiens/{id}', [PasienController::class, 'destroy']);

// API Dokter
Route::get('/dokters', [DokterController::class, 'index']);
Route::post('/dokters', [DokterController::class, 'store']);
Route::get('/dokters/{id}', [DokterController::class, 'show']);
Route::put('/dokters/{id}', [DokterController::class, 'update']);
Route::delete('/dokters/{id}', [DokterController::class, 'destroy']);
