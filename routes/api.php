<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// GET
Route::get("cart/list", [RouteController::class, "cartList"]);
Route::get("category/list", [RouteController::class, "categorylist"]);
Route::get("contact/list", [RouteController::class, "contactlist"]);
Route::get("order", [RouteController::class, "order"]);
Route::get("orderlist", [RouteController::class, "orderList"]);
Route::get("product/list", [RouteController::class, "productList"]);
Route::get("user/list", [RouteController::class, "userlist"]);

// POST
Route::post("category/create", [RouteController::class, "createCategory"]);
Route::post("category/details", [RouteController::class, "detailsCategory"]);
Route::post("category/update", [RouteController::class, "updateCategory"]);
Route::post("category/delete", [RouteController::class, "deleteCategory"]);
Route::post("contact/create", [RouteController::class, "contactCategory"]);
