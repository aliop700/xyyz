<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function car()
    {
        return $this->belongsTo(\App\Car::class);
    }
}
