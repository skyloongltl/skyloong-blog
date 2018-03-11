<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'is_top', 'excerpt', 'slug',];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_articles', 'article_id', 'tag_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
