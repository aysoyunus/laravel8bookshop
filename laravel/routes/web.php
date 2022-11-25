<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('/kategori/{category:slug}', [\App\Http\Controllers\Frontend\CategoryController::class, 'index']);

Route::get("/giris", [AuthController::class, 'showSignInForm']);
Route::post("/giris", [AuthController::class, 'signIn']);

Route::get("/uye-ol", [AuthController::class, 'showSignUpForm']);
Route::post("/uye-ol", [AuthController::class, 'signUp']);

Route::get("/cikis", [AuthController::class, 'logout']);

Route::group(["middleware" => "auth"], function () {
    Route::get("/sepetim", [CartController::class, 'index']);
    Route::get("/sepetim/ekle/{product}", [CartController::class, 'add']);
    Route::get("/sepetim/sil/{cartDetails}", [CartController::class, 'remove']);

    Route::get("/satin-al", [CheckoutController::class, 'showCheckoutForm']);
    Route::post("/satin-al", [CheckoutController::class, 'checkout']);
});


Route::group(["middleware" => "auth"], function () {
    Route::resource("/panel", UserController::class);
    Route::resource("/users", UserController::class);
    Route::get("/users/sil/{user}", [UserController::class, 'destroy']);

    Route::get("/users/{user}/change-password", [UserController::class, 'passwordForm']);
    Route::post("/users/{user}/change-password", [UserController::class, 'changePassword']);
    Route::resource("/users/{user}/addresses", AddressController::class);

    Route::resource("/categories", CategoryController::class);
    Route::get("/categories/sil/{category}", [CategoryController::class, 'destroy']);

    Route::resource("/products", ProductController::class);
    Route::get("/products/sil/{product}", [ProductController::class, 'destroy']);



    Route::resource("/products/{product}/images", ProductImageController::class);

   
});


