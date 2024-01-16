<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogCat(){
        return $this->belongsTo(BlogCategory::class, 'blog_categories_id','id');
    }
}
