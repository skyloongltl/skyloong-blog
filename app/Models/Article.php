<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'tags_id', 'category_id', 'reply_count', 'view_count', 'is_top', 'excerpt', 'slug'];
}
