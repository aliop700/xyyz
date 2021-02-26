<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;

class Product extends Model
{

    protected $guarded = [];
    protected $with = ['file', 'car'];

    public function car()
    {
        return $this->belongsTo(\App\Car::class);
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id', 'image');
    }
}
