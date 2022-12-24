<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Products\ProductCreate;
use App\Http\Livewire\Products\ProductEdit;

   Route::get('products/create',ProductCreate::class)->name('products.create');
   Route::resource('products', ProductController::class, ['only'=> ['index']]);
   Route::get('product/edit/{product:slug}', ProductEdit::class)->name('product.edit');

