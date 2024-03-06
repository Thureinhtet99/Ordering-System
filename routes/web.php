<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\UserListController;

// Login & Register
Route::redirect('/', 'loginpage');
Route::get("loginpage", [AuthController::class, "loginPage"])->name("auth#loginPage");
Route::get("registerpage", [AuthController::class, "registerPage"])->name("auth#registerPage");

// Middleware
Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard', [AuthController::class, "dashboard"])->name("dashboard");

    // ADMIN
    Route::prefix('admin')->middleware(["admin_auth"])->group(function () {

        // category
        Route::get("categorypage", [CategoryController::class, "adminCategory"])->name("admin#category");
        Route::get("categorycreatepage", [CategoryController::class, "adminCreate"])->name("admin#create");
        Route::post("categoryformpage", [CategoryController::class, "adminCreateForm"])->name("admin#createForm");
        Route::get("categorydelete/{id}", [CategoryController::class, "adminDelete"])->name("admin#Delete");
        Route::get("categoryedit/{id}", [CategoryController::class, "adminEdit"])->name(("admin#Edit"));
        Route::post("categoryupdate/{id}", [CategoryController::class, "adminUpdate"])->name(("admin#Update"));

        // password
        Route::get("passwordchange", [AuthController::class, "adminPassword"])->name("admin#password#change");
        Route::post("passwordchangeform", [AuthController::class, "adminPasswordForm"])->name("admin#passwordchangeFrom");

        // account
        Route::get("account/detail", [AuthController::class, "accountDetail"])->name("account#detail");
        Route::get("account/edit", [AuthController::class, "accountEdit"])->name("account#edit");
        Route::post("account/update/{id}", [AuthController::class, "accountUpdate"])->name("account#update");

        // admin list
        Route::get("account/list", [AuthController::class, "accountList"])->name("account#list");
        Route::get("account/delete/{id}", [AuthController::class, "accountDelete"])->name("account#delete");
        Route::get("account/role/{id}", [AuthController::class, "accountRole"])->name("account#role");
        Route::post("account/changerole/{id}", [AuthController::class, "accountChangeRole"])->name("account#changeRole");

        // order
        Route::prefix('order')->group(function () {
            Route::get("list", [OrderController::class, "orderList"])->name("admin#order#list");
            Route::get("list/change", [OrderController::class, "orderListChange"])->name("admin#order#listChange");
            Route::get("list/statuschange/ajax", [OrderController::class, "statusChangeAjax"])->name("admin#order#list#statuschange#ajax");
            Route::get("list/ordercodestatus/{orderCodeStatus}", [OrderController::class, "orderCodeStatus"])->name("admin#order#orderCodeStatus");
            // Route::get("list/productlist", [OrderController::class, "productList"])->name("admin#order#productList");
        });

        // contact
        Route::prefix('contact')->group(function () {
            Route::get("index", [AuthController::class, "contactIndex"])->name("admin#contact#index");
            Route::get("details/{id}", [AuthController::class, "contactDetails"])->name("admin#contact#details");
            Route::get("index/delete/{id}", [AuthController::class, "indexDelete"])->name("admin#contact#delete");
        });

        // user list
        Route::prefix('userlist')->group(function () {
            Route::get("index", [UserListController::class, "index"])->name("userList#index");
            Route::get("index/changerole/ajax", [UserListController::class, "changeRole"])->name("userList#changeRole#ajax");
        });
    });


    // products
    Route::prefix('products')->group(function () {
        Route::get("list", [ProductController::class, "list"])->name("product#list");
        Route::get("createpage", [ProductController::class, "createPage"])->name("product#createPage");
        Route::post("create", [ProductController::class, "create"])->name("product#create");
        Route::get("delete/{id}", [ProductController::class, "delete"])->name("product#delete");
        Route::get("edit/{id}", [ProductController::class, "edit"])->name("product#edit");
        Route::get("updatepage/{id}", [ProductController::class, "updatePage"])->name("product#updatePage");
        Route::post("update/{id}", [ProductController::class, "update"])->name("product#update");
    });

    // USER
    Route::prefix('user')->middleware(["user_auth"])->group(function () {

        Route::get("categorypage", [UserController::class, "userCategory"])->name("user#category");
        Route::get("filter/{id}", [UserController::class, "filter"])->name("user#filter");

        // category
        Route::prefix('category')->group(function () {
            Route::get("details/{id}", [UserController::class, "detail"])->name("user#category#details");
            Route::get("cart", [UserController::class, "cart"])->name("user#category#cart");
            Route::get("history", [UserController::class, "history"])->name("user#category#history");
        });

        // cart
        Route::prefix('cart')->group(function () {
            Route::get("index", [UserController::class, "index"])->name("user#cart#index");
        });

        // password
        Route::prefix('password')->group(function () {
            Route::get("change", [UserController::class, "changePassword"])->name("user#changepassword");
            Route::post("change", [UserController::class, "changePasswordForm"])->name("user#changepassword#form");
        });

        // profile
        Route::prefix('profile')->group(function () {
            Route::get("account", [UserController::class, "accountPage"])->name("account#Page");
            Route::get("accountchange", [UserController::class, "accountChangePage"])->name("account#changePage");
            Route::post("accountupdate/{id}", [UserController::class, "accountUpdatePage"])->name("account#updatePage");
        });

        // contact
        Route::prefix('contact')->group(function () {
            Route::get("index", [ContactController::class, "contactIndex"])->name("user#contact#index");
            Route::post("indexform", [ContactController::class, "contactIndexForm"])->name("user#contact#indexForm");
        });

        // ajax
        Route::prefix('ajax')->group(function () {
            Route::get("list", [AjaxController::class, "ajaxList"])->name("ajax#list");
            Route::get("cart", [AjaxController::class, "ajaxCart"])->name("ajax#cart");
            Route::get("order", [AjaxController::class, "ajaxOrder"])->name("ajax#order");
            Route::get("clearcart", [AjaxController::class, "ajaxclearCart"])->name("ajax#clearCart");
            Route::get("clearcurrentcart", [AjaxController::class, "ajaxClearCurrentCart"])->name("ajax#clearCurrentCart");
            Route::get("increasecount", [AjaxController::class, "increaseCount"])->name("ajax#increaseCount");
        });
    });
});
