<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    protected $table = 'post_categories';
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Posts::class, 'category_id');
    }
}
