<?php

namespace App\Models;

class Article extends Model
{
    use Traits\TopArticleHelper;

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

    public function scopeGetTop()
    {
        return $this->select('id', 'title')->where('is_top', 1)->orderBy('id', 'desc')->take(10)->get();
    }
}
