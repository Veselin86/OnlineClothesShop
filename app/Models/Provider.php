<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'e_mail', 'contact_person'];

    public function addresses() 
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
