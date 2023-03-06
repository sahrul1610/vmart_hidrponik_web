<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transactions";

    protected $guarded = [''];

    public $timestamps = false;

    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'users_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransaksiItem::class, 'transactions_id');
    }
}
