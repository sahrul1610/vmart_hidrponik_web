<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "products";

    protected $guarded = [''];

    public $timestamps = false;

    public function getKategori()
    {
        // SELECT * FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori
        return $this->belongsTo(Kategori::class, 'categories_id');
        // return $this->belongsTo(ModelYangInginDiJoin, AtributJoinChild , AtributJoinParent)
       // return $this->hasOne("App\Models\Kategori", "id", "categories_id");

    }

    public function produkgaleri()
    {
        return $this->hasOne(Produkgaleri::class, 'products_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }

}
