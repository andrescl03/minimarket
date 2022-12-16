<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\File;
use App\Models\TypeVariation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{

    use WithFileUploads;

    public $categories;
    public $photo;
    public $name;
    public $sku;
    public $description;
    public $purcharse;
    public $sale_suggested;
    public $stock;
    public $category;
    public $delivery = 0;
    public $files = [];
    public $type_variation;
    public $type_variations;

    protected $listeners = [ 'click'];

    public function render()
    {
        $this->categories = Category::get();
        $this->type_variations = TypeVariation::get();
        return view('livewire.products.product-create')->extends('admin.layouts.main')->section('content');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => ['image', 'max:2048', 'mimes:jpg,png,jpeg']
        ]);
    }


    public function updatedFiles()
    {
        $this->validate([
            'files.*' => ['image', 'max:4096', 'mimes:jpg,png,jpeg']
        ]);
    }


    public function addTypevariation(){

        dd("ea");
    }
    public function click(){

        $this->emit('verificar');

        $this->dispatchBrowserEvent('show',['data' => $this->type_variation]);


    }
    public function submit()
    {
        $this->name = trim($this->name);
        $this->slug = Str::slug($this->name);

        $validator =  Validator::make(
            [
                'name' => $this->name,
                'description' => $this->description,
                'category' => $this->category,
                'sale_suggested' => $this->sale_suggested,
                'purcharse' => $this->purcharse,
                'sku' => $this->sku,
                'stock' => $this->stock,
                'photo' => $this->photo,
                'files' => $this->files
            ],
            [
                'name' => ['required', 'min:2', 'string', 'unique:products,name', 'max:255'],
                'description' => ['required', 'min:2',  'string', 'max:500'],
                'category' => ['required', 'integer', 'exists:categories,id'],
                'sale_suggested' => ['required'],
                'purcharse' => ['required'],
                'sku' => ['required'],
                'stock' => ['required'],
                'photo' => ['image'],
                'files' => ['required']
            ]
        );

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('show-message');
        }
        $validator->validate();

        $path_url = $this->photo->store('photos');
        $product = Product::create(
            [
                'name' => $this->name,
                'description' => $this->description,
                'purcharse' => $this->purcharse,
                'slug' => Str::slug($this->name),
                'sale_suggested' => $this->sale_suggested,
                'photo' => $path_url,
                'sku' => $this->sku,
                'stock' => $this->stock,
                'delivery' => $this->delivery,
                'category_id' => $this->category
            ]
        );

        foreach ($this->files as  $file) {
            $fileUPload = $file->store('photos');
            $file = File::create(
                [
                    'name' => $file->getClientOriginalName(),
                    'url' =>  $fileUPload,
                    'format' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'weight' => $file->getSize()
                ]
            );
            $product->files()->attach($file->id);
        }
    }
 
}
