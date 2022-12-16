<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::resource('servicios', ServiceController::class);

?>