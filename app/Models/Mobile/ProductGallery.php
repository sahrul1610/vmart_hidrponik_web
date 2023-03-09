<?php

namespace App\Models\Mobile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'products_id',
        'url',
    ];

    public function getUrlAttribute($url)
    {
        $storageUrl = Storage::url($url);
        // $baseUrl = rtrim(config('app.url'), '/');

        return "{$storageUrl}";
        //return config('app.url') . Storage::url($url);
    }
}
