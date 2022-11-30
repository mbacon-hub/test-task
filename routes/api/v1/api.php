<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:api")->group(function() {
    Route::prefix("products/")->group(function () {
        Route::get("/", [\App\Api\V1\Controllers\ProductController::class, "index"]);
        Route::post("store", [\App\Api\V1\Controllers\ProductController::class, "store"]);
        Route::put("/update/{productId}", [\App\Api\V1\Controllers\ProductController::class, "update"])->where("productId", "[0-9]+");
        Route::delete("/delete/{productId}", [\App\Api\V1\Controllers\ProductController::class, "delete"])->where("productId", "[0-9]+");

        Route::post("/buy", [\App\Api\V1\Controllers\ProductController::class, "buy"])->where("productId", "[0-9]+");
    });

    Route::prefix("operations/")->group(function () {
        Route::get("/", [\App\Api\V1\Controllers\OperationController::class, "index"]);
    });
});

Route::post("/auth", [\App\Api\V1\Controllers\AuthController::class, "login"]);

