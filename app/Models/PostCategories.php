<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    use HasFactory;
    protected $table = "post_categories";

    protected $guarded = [''];

    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Posts::class);
    }
}
