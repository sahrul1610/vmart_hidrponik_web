<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = "posts";

    protected $guarded = [''];

    public $timestamps = false;

    public function categories()
    {
        return $this->belongsTo(PostCategories::class, 'categories_id','id');
    }
}
