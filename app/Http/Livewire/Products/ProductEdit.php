<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\State;
use App\Models\TypeVariation;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $name;
    public $description;
    public $photo;
    public $purcharse;
    public $sale_suggested;
    public $stock;
    public $delivery;
    public $category_id;
    public $state_id;
    public $sku;
    public $margin_of_gain;
    public $imageUpdateTemporary = 0;
    public $type_variation = [];

    public function mount(Product $product)
    {

        $this->categories = Category::all();
        $this->type_variations = TypeVariation::all();
        $this->states = State::all();

        $this->name = $product->name;
        $this->description = $product->description;
        $this->photo = $product->photo;
        $this->purcharse = $product->purcharse;
        $this->sale_suggested = $product->sale_suggested;
        $this->stock = $product->stock;
        $this->delivery = $product->delivery;
        $this->category_id = $product->category_id;
        $this->state_id = $product->state_id;
        $this->sku = $product->sku;
        $this->margin_of_gain = $product->margin_of_gain;

    }
    public function render()
    {
        return view('livewire.products.product-edit')->extends('admin.layouts.main')->section('content');
    }
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => ['image', 'max:2048', 'mimes:jpg,png,jpeg']
        ]);
        $this->imageUpdateTemporary = 1;
    }


}
