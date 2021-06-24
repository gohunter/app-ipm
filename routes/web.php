<?php

use App\Http\Controllers\DocumentController;
use App\Http\Livewire\Config\IndexConfig;
use App\Http\Livewire\Document\IndexDocument;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/config', IndexConfig::class)->name('config.index')->middleware(['auth:sanctum', 'verified']);
Route::get('/documentos', IndexDocument::class)->name('document.index')->middleware(['auth:sanctum', 'verified']);

Route::get('/documentos/qr/download/{document}', [DocumentController::class, 'qrDownload'])->name('document.qrdownload')->middleware(['auth:sanctum', 'verified']);
