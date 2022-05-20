<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\penggunaController;


Route::get('/',[penggunaController::class,'add']);
Route::get('/add',[penggunaController::class,'add']);

Route::post('/balas',[penggunaController::class,'balasmessage']);

Route::post('/add/simpan',[penggunaController::class,'save']);

Route::post('/message/simpan',[penggunaController::class,'savemessage']);

Route::get('/{number}',[penggunaController::class,'message']);

