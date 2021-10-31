<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\API\AuthController;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('logout',[AuthController::class,'logout']);


    Route::get('products',[ProductController::class,'index']);
    Route::get('products/{id}/show',[ProductController::class,'show']);
    Route::post('product/add',[ProductController::class,'store']);
    Route::post('product/{id}/update',[ProductController::class,'update']);
    Route::delete('product/{id}/delete',[ProductController::class,'destroy']);

});