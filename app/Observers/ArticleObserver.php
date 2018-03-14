<?php

namespace App\Observers;

use App\Models\Article;
use Cache;
use App\Models\Tag;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function saved(Article $article)
    {
        $top_articles = $article->getTop();
        $tags = Tag::all();
        Cache::put('top_articles', $top_articles, 43200);
        Cache::put('tags', $tags, 43200);
    }

    public function deleted(Article $article)
    {
        $top_articles = $article->getTop();
        Cache::put('top_articles', $top_articles, 43200);
    }
}