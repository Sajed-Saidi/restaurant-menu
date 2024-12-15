<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'menu']);

Route::get('qr-code', function () {
    return view('qr-code');
});

Route::get('/test', function () {
    return "adfasdf";
});
