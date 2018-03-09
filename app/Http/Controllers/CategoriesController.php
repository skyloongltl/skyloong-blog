<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\URL;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $articles = Article::where('category_id', $category->id)->orderBy('created_at', 'desc')->with('tags', 'category')->paginate(15);
        return view('articles.index', compact('articles', 'category'));
    }
}
