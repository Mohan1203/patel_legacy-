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

    Route::get('/addcategory', [BlogCategoryController::class,'index']);
  

    // Product routes
    Route::get('/products', [ProductController::class,'index']);
    Route::post("/addProduct", [ProductController::class,'create'])->name("handle.addProduct");
   
    Route::post("/deleteProduct/{id}", [ProductController::class,'destroy'])->name("handle.deleteProduct");
    Route::get("/editProduct/{id}", [ProductController::class,'edit'])->name("handle.editProduct");
    Route::put("/updateProduct/{id}", [ProductController::class,'update'])->name("handle.updateProduct");

    // Blog category routes
    Route::post("/addCategory", [BlogCategoryController::class,'create'])->name("handle.addCategory");
    Route::post("/deleteCategory/{id}", [BlogCategoryController::class,'destroy'])->name("handle.deleteCategory");
    Route::get("/editCategory/{id}", [BlogCategoryController::class,'edit'])->name("handle.editCategory");
    Route::put("/updateCategory/{id}", [BlogCategoryController::class,'update'])->name("handle.updateCategory");

    // Blog routes
    Route::get('/', [BlogController::class,'index']);
    Route::post("/addBlog", [BlogController::class,'create'])->name("handle.addBlog");
    Route::post('/uploadImage', [BlogController::class,'uploadImage'])->name('blogs.upload-image');
    Route::get("/editBlog/{id}", [BlogController::class,'edit'])->name("handle.editblog")->name("handle.editBlog");
    Route::put("/updateBlog/{id}", [BlogController::class,'update'])->name("handle.updateBlog");
    Route::post("/deleteBlog/{id}", [BlogController::class,'destroy'])->name("handle.deleteBlog");

    // Feature route
    Route::post("/addFeature", [ProductController::class,'updateFeatureSection'])->name("handle.addFeature");

    // Setting route
    Route::get("/settings", [SettingController::class,'index']);
    Route::post("/addSetting", [SettingController::class,'create'])->name("handle.addSetting");
    Route::get("/editSetting/{id}", [SettingController::class,'edit'])->name("handle.editSetting");
    Route::put("/updateSetting/{id}", [SettingController::class,'update'])->name("handle.updateSetting");
    Route::post("/deleteSetting/{id}", [SettingController::class,'destroy'])->name("handle.deleteSetting");
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