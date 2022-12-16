<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'format',
        'size',
        'weight'
    ];

    public function categories()
    { 
        return $this->BelongsToMany(Category::class);
    }

    public function products()
    { 
        return $this->BelongsToMany(Product::class);
    }
}
