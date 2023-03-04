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
        return $this->belongsTo(User::class);
    }
}
