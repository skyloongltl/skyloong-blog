<?php

namespace App\Models\Traits;

use App\Models\Article;
use Cache;

trait TopArticleHelper
{
    protected $cache_minutes = 43200;

    public function cacheTopArticle()
    {
        $top_articles = Article::getTop();
        Cache::put('top_articles', $top_articles, $this->cache_minutes);
    }
}