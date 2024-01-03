<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryArticle;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'thumbnail', 'slug', 'content', 'highlight', 'status'];

    public function categoryArticle()
    {
        return $this->hasOne('App\Models\CategoryArticle');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_articles');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'tag_articles');
    }   
}
