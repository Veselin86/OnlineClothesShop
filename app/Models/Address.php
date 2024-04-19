<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['line_1', 'line_2', 'city', 'post_code', 'country'];

    public function addressable() 
    {
        return $this->morphTo();
    }
}
