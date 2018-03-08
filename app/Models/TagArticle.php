<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagArticle extends Model
{
    protected $table = 'tags_articles';
    protected $fillable = ['tag_id', 'article_id'];
}
