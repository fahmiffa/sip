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
Route::post('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('sign');
Route::get('/daftar', [App\Http\Controllers\AuthController::class, 'reg'])->name('daftar');
Route::post('/daftar', [App\Http\Controllers\AuthController::class, 'daftar'])->name('reg');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {    
    Route::group(['prefix'=>'home'],function() {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');      
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
    
        // Route::group(['prefix'=>'formulir'],function() {   
        //     Route::resource('document', App\Http\Controllers\DocumentController::class);  
        //     Route::get('step/{id}', [App\Http\Controllers\DocumentController::class, 'step'])->name('step.index');    
        //     Route::post('step-store/{id}', [App\Http\Controllers\DocumentController::class, 'steps'])->name('step.store');    
        //     Route::post('step-destroy/{id}', [App\Http\Controllers\DocumentController::class, 'stepd'])->name('step.destroy');    
        // });
    });


    Route::group(['prefix'=>'dokumen'],function() {   
        Route::resource('document', App\Http\Controllers\HeadController::class);  
    });
});



