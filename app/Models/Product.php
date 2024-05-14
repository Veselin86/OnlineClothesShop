<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'sizes', 'colors', 'image', 'provider_id', 'category_id'];

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sale')
            ->withTimestamps()
            /* ->withPivot() */;
    }
}
