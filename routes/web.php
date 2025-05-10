<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;


Route::get('/', [BlogController::class,'index']);
Route::get('/addcategory', [BlogCategoryController::class,'index']);
Route::get('/products', [ProductController::class,'index']);
Route::get("/settings", [SettingController::class,'index']);