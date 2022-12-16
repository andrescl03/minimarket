<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

Route::resource('sales', SaleController::class);

?>