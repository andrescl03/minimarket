<?php

namespace App\Http\Livewire\Sales;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Sales extends Component
{

    public $categories;
    public $productsCart = [];

    protected $listeners = ['addProductCart'];

    public function render()
    {

        $this->categories = Category::all();
        return view('livewire.sales.sales');
    }


    public function submit(Product $product)
    {
        array_push($this->productsCart  , $product);

        $this->dispatchBrowserEvent('show-notification', [
            'title' => 'se agregó el producto al carrito'
        ]);

    }

    public function continuar()
    {
        dd($this->productsCart);
    }
}
