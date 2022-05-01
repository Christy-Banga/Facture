<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FactureMoisController;
use App\Http\Controllers\IncoherenceController;
use App\Http\Controllers\NotificationController;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

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


Route::group(['middleware' => 'auth'],function(){
    Route::resource('/facture',FactureController::class);
    Route::get('/display_lines',[FactureController::class,'displayLine'])->name('display_lines');
    Route::post('/read_lines',[FactureController::class,'readLines'])->name('read_lines');
    Route::post('/save_file',[FactureController::class,'saveFile'])->name('save_file');
    Route::get('/generatePDF',[FactureController::class,'generatePDF'])->name('generatePDF');

    Route::resource('/gestionnaire', UserController::class);

    Route::get('/',[FactureMoisController::class,'index'])->name('dashboard');

    //notification
   /*  Route::get('/mark-one/{id}',[NotificationController::class,'store'])->name('notifications.store'); */
   Route::get('/notifications',[NotificationController::class,'index'])->name('notifications');
   Route::delete('/delete/{id}',[NotificationController::class,'destroy'])->name('destroy.notification');
   Route::get('/incoherence',[IncoherenceController::class,'index'])->name('incoherence');

});





require __DIR__.'/auth.php';
