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
        //$storageUrl = Storage::url($url);
        // // $baseUrl = rtrim(config('app.url'), '/');

        // return "{$storageUrl}";
        //$storageUrl = Storage::url("gambar/$url");
        // //$baseUrl = rtrim(config('app.url'), '/');

        //return "{$storageUrl}";

        //    $test = "https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.07.10%20(1).jpg";
        // return ( $test);
        //return config('app.url') . Storage::url("$url");
        return("$url");
    }
}
