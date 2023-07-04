<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'category_id'];

    public function categories()
    {
        return $this->belongsTo(PostCategories::class, 'category_id');
    }
}
