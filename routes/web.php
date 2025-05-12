<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\ApplicationController;
use App\Http\Controllers\Front\ERDiagramController;
use App\Http\Controllers\Front\UserController;

Route::get('/', function () {
    return view('welcome');
});   

// pages
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/service', [PagesController::class, 'service'])->name('service');
Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
Route::get('/contact-us', [PagesController::class, 'contact'])->name('contactus');
Route::get('/faqs', [PagesController::class, 'faqs'])->name('faqs');
Route::get('/testimonials', [PagesController::class, 'testimonials'])->name('testimonials');

// Auth user
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/otp/{id}', [AuthController::class, 'otp'])->name('otp');
Route::post('/otp-verify/{id}', [AuthController::class, 'otpVerify'])->name('otpverify');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'customLogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// user onboard
Route::get('/user-onboard', [ApplicationController::class, 'showOnboardForm'])->name('showonboardform');
Route::post('/onboarding-submit', [ApplicationController::class, 'onboardSubmit'])->name('onboardsubmit');

// auth user routes
Route::middleware(['auth'])->group(function () {

    Route::get('/options', [ApplicationController::class, 'option'])->name('option');
    Route::get('/create/{type}', [ApplicationController::class, 'appForm'])->name('showform');
    Route::get('/user-dashboard', [UserController::class, 'userDashboard'])->name('userdashboard');
    Route::get('/settings', [UserController::class, 'accountSettings'])->name('accountsettings');

    //csv export
    Route::get('/csv-export', [ApplicationController::class, 'csvExport'])->name('csvexport');



    //application dashboard
    Route::get('/app-dashboard/{name}', [ApplicationController::class, 'appDashboard'])->name('appdashboard');
    Route::get('/app-settings/{name}', [ApplicationController::class, 'appSettings'])->name('appsettings');

    //application dynamic table listing
    Route::get('/{table}/{appname}', [ApplicationController::class, 'tableListing'])->name('tablelisting');

    // show all forms
    Route::get('/form/{table}/{appname}', [ApplicationController::class, 'showTableForm'])->name('addtablefields');
    Route::post('/save-form/{table}/{appname}', [ApplicationController::class, 'saveForm'])->name('saveform');

    // show edit forms
    Route::get('/edit/{table}/{appname}/{id}', [ApplicationController::class, 'editShowTableForm'])->name('edittablefields');
    Route::post('/update-form/{table}/{appname}/{id}', [ApplicationController::class, 'updateForm'])->name('updateform');

    // show view details 
    Route::get('/view/{table}/{appname}/{id}', [ApplicationController::class, 'viewTableDetails'])->name('viewtablefields');

    // delete table record
    Route::get('/delete/{table}/{appname}/{id}', [ApplicationController::class, 'deleteTableDetails'])->name('deletetablefields');
   
});

// ER diagrams
Route::get('/erd', [ERDiagramController::class, 'index']);
Route::get('/test', [ERDiagramController::class, 'test']);
Route::post('/erd/save', [ERDiagramController::class,'save'])->name('erd.save');


