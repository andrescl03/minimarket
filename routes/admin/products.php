<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Products\ProductCreate;

   Route::get('products/create',ProductCreate::class)->name('products.create');
   Route::resource('products', ProductController::class, ['only'=> ['index']]);
   
