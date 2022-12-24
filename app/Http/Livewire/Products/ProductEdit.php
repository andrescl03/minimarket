<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{

    public Product $product;
    public $name;

    public function mount(Product $product){

        $this->product = $product;
     
    }
    public function render()
    {       

        return view('livewire.products.product-edit')->extends('admin.layouts.main')->section('content');
    }
}
