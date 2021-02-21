<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()
    {
        return $this->hasMany(\App\OrderItem::class);
    }

    public function reCalculateTotal()
    {
        $total = $this->items->reduce(function($carry, $item) {
            return $carry + $item->price * $item->quantity; 
        });
        
        $this->total = $total;
        $this->save();
    }
}
