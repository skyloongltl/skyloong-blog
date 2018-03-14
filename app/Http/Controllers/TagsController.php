<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Article;
use App\Models\TagArticle;

class TagsController extends Controller
{
    public function index(Request $request, Tag $tag)
    {
        $tags = $tag->all();
    }

    public function show(Request $request, Tag $tag)
    {
        $article_ids = TagArticle::select('article_id')->where('tag_id', $tag->id)->get();
        $articles = Article::whereIn('id', $article_ids)->with('category', 'tags')->paginate(15);
        $articles->tag_name = $tag->name;

        return view('articles.index', compact('articles'));
    }

    public function destroy(Request $request, Tag $tag)
    {

    }
}
