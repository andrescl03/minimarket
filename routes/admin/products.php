<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Products\ProductCreate;
use App\Http\Livewire\Products\ProductEdit;

   Route::get('producto/crear',ProductCreate::class)->name('product.create');
   Route::resource('productos', ProductController::class, ['only'=> ['index']]);
   Route::get('producto/editar/{product:slug}', ProductEdit::class)->name('product.edit');

