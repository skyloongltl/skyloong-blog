<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'reply_count', 'view_count', 'is_top', 'excerpt', 'slug'];
}
