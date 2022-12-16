<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;
    
    public $search;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        $KeyWord = '%' . $this->search . '%';
        return view('livewire.products.products', [
            'products' => Product::latest()->where('name', 'LIKE', $KeyWord)->orWhere('description', 'LIKE', $KeyWord)->paginate(5)
        ]);
    }
}
