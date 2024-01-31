<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\UserController;

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
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('home');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('sign');
Route::get('/daftar', [App\Http\Controllers\AuthController::class, 'reg'])->name('daftar');
Route::post('/daftar', [App\Http\Controllers\AuthController::class, 'daftar'])->name('reg');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {    
    Route::group(['prefix'=>'home'],function() {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');      
    });

    Route::group(['prefix'=>'verifikator'],function() {        
        Route::resource('verification', App\Http\Controllers\VerificationController::class);  
        Route::get('verifikasi-step/{id}', [App\Http\Controllers\VerificationController::class, 'step'])->name('step.verifikasi');  
        Route::post('next-step/{id}', [App\Http\Controllers\VerificationController::class, 'next'])->name('next.verifikasi');    
        Route::post('back-step/{id}', [App\Http\Controllers\VerificationController::class, 'back'])->name('back.verifikasi');  
        Route::post('village}', [App\Http\Controllers\VerificationController::class, 'village'])->name('village');        
    });   
    });

    Route::group(['prefix'=>'master'],function() {   
        Route::group(['prefix'=>'account'],function() {   
            Route::resource('role', App\Http\Controllers\Account\RoleController::class);  
            Route::resource('permission', App\Http\Controllers\Account\PermissionController::class);  
            Route::resource('user', App\Http\Controllers\Account\UserController::class);            
        });
        Route::group(['prefix'=>'dokumen'],function() {   
            Route::resource('formulir', App\Http\Controllers\FormulirController::class);  
            Route::resource('letter', App\Http\Controllers\LetterController::class);  
            Route::resource('header', App\Http\Controllers\Item\HeaderController::class);  
            Route::resource('footer', App\Http\Controllers\Item\FooterController::class);    
            Route::resource('title', App\Http\Controllers\Item\TitleController::class);  
            Route::resource('item', App\Http\Controllers\Item\ItemController::class);     
            Route::resource('sub', App\Http\Controllers\Item\SubController::class);         
        });    
        Route::resource('kecamatan', App\Http\Controllers\DistrictController::class);  
        Route::resource('desa', App\Http\Controllers\VillageController::class);  
    
        // Route::group(['prefix'=>'formulir'],function() {   
        //     Route::resource('document', App\Http\Controllers\DocumentController::class);  
        //     Route::get('step/{id}', [App\Http\Controllers\DocumentController::class, 'step'])->name('step.index');    
        //     Route::post('step-store/{id}', [App\Http\Controllers\DocumentController::class, 'steps'])->name('step.store');    
        //     Route::post('step-destroy/{id}', [App\Http\Controllers\DocumentController::class, 'stepd'])->name('step.destroy');    
        // });
    });

    Route::group(['prefix'=>'dokumen'],function() {   
        Route::resource('verifikasi', App\Http\Controllers\HeadController::class);     
});



