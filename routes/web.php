<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    require_once __DIR__ . "/admin/user.php";
    require_once __DIR__ . "/admin/products.php";
    require_once __DIR__ . "/admin/categories.php";
    require_once __DIR__ . "/admin/sales.php";
});
