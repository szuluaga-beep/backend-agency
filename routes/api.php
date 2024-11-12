<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/products", function () {
    return "Products list";
});

Route::get("/products/{id}", function () {
    return "Return one product";
});

Route::post("/products", function () {
    return "Creando producto";
});

Route::patch("/products/{id}", function () {
    return "Actualizando producto";
});

Route::delete("/products/{id}", function () {
    return "Deleting product ";
});
