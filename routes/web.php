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
Route::get('/manjing', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('home');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('sign');
Route::get('/forgot', [App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot');
Route::post('/forgot', [App\Http\Controllers\AuthController::class, 'forget'])->name('forget');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/reload-captcha', [App\Http\Controllers\AuthController::class, 'reloadCaptcha']);

Route::group(['middleware' => 'auth'], function() {    

    Route::group(['prefix'=>'home'],function() {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');      
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

    Route::group(['prefix'=>'task'],function() {  
        Route::resource('verification', App\Http\Controllers\VerificationController::class);  
        Route::get('doc-verifikator/{id}', [App\Http\Controllers\VerificationController::class, 'doc'])->name('doc.verifikator');  
        Route::get('verifikasi-step/{id}', [App\Http\Controllers\VerificationController::class, 'step'])->name('step.verifikasi');  
        Route::get('edit-step/{id}', [App\Http\Controllers\VerificationController::class, 'modif'])->name('edit.verifikasi');  
        Route::post('next-step/{id}', [App\Http\Controllers\VerificationController::class, 'next'])->name('next.verifikasi');    
        Route::post('back-step/{id}', [App\Http\Controllers\VerificationController::class, 'back'])->name('back.verifikasi'); 
        Route::post('next-tahap/{id}', [App\Http\Controllers\VerificationController::class, 'nexts'])->name('nexts.verifikasi');  

        Route::resource('news', App\Http\Controllers\NewsController::class);  
        Route::get('doc-news/{id}', [App\Http\Controllers\NewsController::class, 'doc'])->name('doc.news'); 
        Route::get('konsultasi/{id}', [App\Http\Controllers\NewsController::class, 'sign'])->name('sign.news');  
        Route::post('news-sign/{id}', [App\Http\Controllers\NewsController::class, 'signed'])->name('signed.news');  
        Route::get('news-step/{id}', [App\Http\Controllers\NewsController::class, 'step'])->name('step.news'); 
        Route::post('next-news/{id}', [App\Http\Controllers\NewsController::class, 'next'])->name('next.news');    
        Route::post('back-news/{id}', [App\Http\Controllers\NewsController::class, 'back'])->name('back.news'); 

        Route::resource('meet', App\Http\Controllers\MeetController::class);  
        Route::get('rapat-pleno/{id}', [App\Http\Controllers\MeetController::class, 'doc'])->name('doc.meet'); 
        Route::get('meet-sign/{id}', [App\Http\Controllers\MeetController::class, 'sign'])->name('sign.meet');  
        Route::post('meet-sign/{id}', [App\Http\Controllers\MeetController::class, 'signed'])->name('signed.meet');  
        Route::get('meet-step/{id}', [App\Http\Controllers\MeetController::class, 'step'])->name('step.meet'); 
        Route::post('next-meet/{id}', [App\Http\Controllers\MeetController::class, 'next'])->name('next.meet');    
        Route::post('back-meet/{id}', [App\Http\Controllers\MeetController::class, 'back'])->name('back.meet'); 

        Route::resource('attach', App\Http\Controllers\AttachController::class);  
        Route::get('doc-attach/{id}', [App\Http\Controllers\AttachController::class, 'doc'])->name('doc.attach'); 
        Route::get('attach-step/{id}', [App\Http\Controllers\AttachController::class, 'step'])->name('step.attach'); 
        Route::get('retribusi-step/{id}', [App\Http\Controllers\AttachController::class, 'stepr'])->name('step.tax'); 
        Route::get('retribusi', [App\Http\Controllers\AttachController::class, 'tax'])->name('tax.index');
        Route::post('retribusi/{id}', [App\Http\Controllers\AttachController::class, 'storeTax'])->name('tax.store');  
        Route::get('doc-retribusi/{id}', [App\Http\Controllers\AttachController::class, 'docs'])->name('doc.tax'); 
    });
    
    Route::group(['prefix'=>'dokumen'],function() {   

        Route::get('bak', [App\Http\Controllers\HeaderController::class, 'bak'])->name('bak.verifikasi');  
        Route::post('bak-apporove/{id}', [App\Http\Controllers\HeaderController::class, 'approveBak'])->name('approve.bak');  
        Route::get('doc-bak/{id}', [App\Http\Controllers\HeaderController::class, 'docBak'])->name('bak.doc');        
        
        Route::get('barp', [App\Http\Controllers\HeaderController::class, 'barp'])->name('barp.verifikasi');  
        Route::post('barp-apporove/{id}', [App\Http\Controllers\HeaderController::class, 'approveBarp'])->name('approve.barp');  
        Route::get('doc-barp/{id}', [App\Http\Controllers\HeaderController::class, 'docBarp'])->name('barp.doc');  
        Route::resource('consultation', App\Http\Controllers\ConsultationController::class);  
        
        Route::resource('schedule', App\Http\Controllers\ScheduleController::class);  
        Route::post('send-schedule/{id}', [App\Http\Controllers\ScheduleController::class, 'send'])->name('schedule.send'); 
        Route::resource('verifikasi', App\Http\Controllers\HeadController::class);  
        Route::post('village', [App\Http\Controllers\HeadController::class, 'village'])->name('village');    
        Route::get('doc-verifikasi/{id}', [App\Http\Controllers\HeadController::class, 'doc'])->name('doc.verifikasi');  
        Route::post('doc-apporove/{id}', [App\Http\Controllers\HeadController::class, 'approve'])->name('doc.approve');  
        Route::post('doc-reject/{id}', [App\Http\Controllers\HeadController::class, 'reject'])->name('doc.reject');            
    });
    Route::get('permohonan', [App\Http\Controllers\OperatorController::class, 'index'])->name('req.index');
    Route::get('permohonan-dokumen/{id}', [App\Http\Controllers\OperatorController::class, 'doc'])->name('req.doc');    
});




