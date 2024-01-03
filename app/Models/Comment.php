<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'full_name', 'content', 'status', 'article_id'];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}   
