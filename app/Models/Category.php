<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function files()
    {
        return $this->BelongsToMany(File::class, 'files_modules')->withTimestamps();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
