<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Web\AppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [AppController::class, "getApp"])
->middleware('auth');

Route::get("/login", [AppController::class, "getLogin"])
->name("login")
->middleware("guest");

Route::get("/get_port", [TestController::class, "getPort"]);
Route::get("/read_port", [TestController::class, "readPort"]);
