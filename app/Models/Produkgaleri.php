<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkgaleri extends Model
{
    use HasFactory;
    protected $table = "product_galleries";

    protected $guarded = [''];

    public $timestamps = false;
}
