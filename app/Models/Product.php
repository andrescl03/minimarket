<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'purcharse',
        'sale_suggested',
        'stock',
        'sku',
        'slug',
        'photo',
        'delivery',
        'category_id'
    ];

    public function files()
    {
        return $this->BelongsToMany(File::class, 'files_modules')->withTimestamps();
    }

   public function type_variations()
    {
        return $this->BelongsToMany(TypeVariation::class, 'products_type_variations')->withTimestamps();
    } 
}
