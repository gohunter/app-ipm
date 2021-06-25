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
    //return view('dashboard');
    return redirect('/documentos');
})->name('dashboard');

Route::get('/config', IndexConfig::class)->name('config.index')->middleware(['auth:sanctum', 'verified']);
Route::get('/documentos', IndexDocument::class)->name('document.index')->middleware(['auth:sanctum', 'verified']);

Route::get('/documentos/qr/download/{document}', [DocumentController::class, 'qrDownload'])->name('document.qrdownload')->middleware(['auth:sanctum', 'verified']);
Route::get('/doc/{uuid}', [DocumentController::class, 'pdfDownload'])->name('document.pdfdownload');
Route::get('/documentos/vdoc/{uuid}', [DocumentController::class, 'vpdfDownload'])->name('document.vpdfdownload')->middleware(['auth:sanctum', 'verified']);
// https://documento.ipm.com.pe/doc/93bf6001-c766-47cc-b858-248963abde80
