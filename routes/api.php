<?php

use App\Http\Controllers\API\DosenController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\UserController;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('mahasiswa', [MahasiswaController::class, 'index']);
Route::post('mahasiswa', [MahasiswaController::class, 'store']);
Route::post('mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::delete('mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

Route::get('dosen', [DosenController::class, 'index']);
Route::post('dosen', [DosenController::class, 'store']);
Route::post('dosen/{id}', [DosenController::class, 'update']);
Route::delete('dosen/{id}', [DosenController::class, 'destroy']);

Route::get('storage/{filename}', [ImageController::class, 'image']);
