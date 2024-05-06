<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'total', 'status'];

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale')
            ->withTimestamps()
            ->withPivot('size', 'color', 'quantity', 'price', 'total');
            /* return $this->belongsToMany(Product::class, "product_sale", "product_id", "sale_id", "id", "id"); */
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
