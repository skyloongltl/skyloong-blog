<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\TagArticle;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends adminBaseController
{
    public function index()
    {
        $tags = Tag::select('id', 'name')->orderBy('id')->paginate(20);
        $tags->page = 20;

        return view('admin.tags.index', compact('tags'));
    }

    public function batchDestroy(Request $request)
    {
        $tag_ids = explode('&', $request->tag_ids);

        $article_ids = TagArticle::whereIn('tag_id', $tag_ids)->pluck('article_id');

        TagArticle::whereIn('tag_id', $tag_ids)->delete();

        Article::whereIn('id', $article_ids)->delete();
        Tag::whereIn('id', $tag_ids)->delete();

        return response()->json(
            [
                'code' => 0,
                'message' => '删除成功'
            ]
        );
    }

    public function destroy(Tag $tag)
    {
        $article_ids = TagArticle::where('tag_id', $tag->id)->get();
        TagArticle::where('tag_id', $tag->id)->delete();
        Article::whereIn('id', $article_ids)->delete();
        $tag->delete();

        return redirect()->route('admin.tags.index');
    }

    public function store(Request $request)
    {
        Tag::insert(
            ['name' => $request->name]
        );

        return redirect()->route('admin.tags.index');
    }
}
