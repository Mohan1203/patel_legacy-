<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('handle.authenticate');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/', [BlogController::class,'index']);
    Route::get('/addcategory', [BlogCategoryController::class,'index']);
    Route::get("/settings", [SettingController::class,'index']);
    Route::get('/products', [ProductController::class,'index']);
    Route::post("/addProduct", [ProductController::class,'create'])->name("handle.addProduct");
    Route::get("/getProducts", [ProductController::class,'show'])->name("handle.getProducts");
    Route::post("/deleteProduct/{id}", [ProductController::class,'destroy'])->name("handle.deleteProduct");
    Route::get("/editProduct/{id}", [ProductController::class,'edit'])->name("handle.editProduct");
    Route::put("/updateProduct/{id}", [ProductController::class,'update'])->name("handle.updateProduct");
});


Route::get('migrate', static function () {
    Artisan::call('migrate');
//    return redirect()->back();
    echo "Done";
    return false;
});

Route::get('admin-seeders', static function () {
    Artisan::call('db:seed --class=AdminSeeder');
    echo "Done";
    return false;
});

Route::get('migrate-rollback', static function () {
    Artisan::call('migrate:rollback');
    echo "Done";
    return false;
});