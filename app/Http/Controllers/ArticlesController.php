<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Handlers\ImageUploadHandler;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$articles = Article::select('id', 'title', 'image', 'section_article', 'category_id', 'created_at')->orderBy('created_at', 'desc')->with('category', 'tags')->paginate(15);
		return view('articles.index', compact('articles'));
	}

    public function show(Article $article)
    {
        $prev_article = Article::select('id', 'title')->where('id', '<', $article->id)->orderBy('id', 'desc')->first();
        $next_article = Article::select('id', 'title')->where('id', '>', $article->id)->first();
        return view('articles.show', compact('article', 'prev_article', 'next_article'));
    }

}