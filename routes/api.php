<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\productController;

Route::get("/products", [productController::class, 'getAllProducts']);

Route::get("/products/{id}", [productController::class, 'show']);

Route::post("/products", [productController::class, 'store']);

Route::patch("/products/{id}", [productController::class, 'update']);

Route::delete("/products/{id}", [productController::class, 'destroy']);
