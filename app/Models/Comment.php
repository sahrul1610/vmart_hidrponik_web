<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function transaction()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id');
    }
}
