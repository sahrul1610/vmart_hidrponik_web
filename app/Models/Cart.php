<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['users_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Produk::class);
    }
}
