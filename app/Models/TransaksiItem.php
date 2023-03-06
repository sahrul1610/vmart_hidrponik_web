<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;
    protected $table = "transaction_items";

    protected $guarded = [''];

    public $timestamps = false;

    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'users_id');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'products_id');
    }

    // public function transaksi()
    // {
    //     return $this->belongsTo(Transaksi::class);
    // }
    public function transaction()
    {
        return $this->belongsTo(Transaksi::class, 'transactions_id', 'id');
    }
}
