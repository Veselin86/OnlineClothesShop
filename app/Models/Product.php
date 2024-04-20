<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'sizes', 'colors', 'image'];

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
    ];

/*     // Opcionalmente, puedes definir métodos accesores específicos si necesitas más control
    public function getSizesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getColorsAttribute($value)
    {
        return json_decode($value, true);
    } */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
