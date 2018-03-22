<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\ArticleRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\Tag;
use App\Models\Reply;

class ArticlesController extends adminBaseController
{
    public function index()
    {
        $articles = Article::select('id', 'title', 'section_article', 'is_top', 'created_at', 'updated_at')
                            ->with('category', 'tags')
                            ->paginate(20);
        $articles->page = 20;
        return view('admin.articles.index', compact('articles'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags_name = array();
        foreach ($article->tags as $val)
        {
            $tags_name[] = $val->name;
        }
        $article->tags_name = implode(':', $tags_name);
        return view('admin.articles.create_and_edit', compact('article', 'categories'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->is_top = $request->is_top;
        $article->save();

        $article->tags()->detach();

        $this->storeTags($request->tags, $article);

        return redirect()->route('articles.show', $article->id)->with('message', '更新成功');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {

        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];

        if ($file = $request->upload_file) {

            $result = $uploader->save($request->upload_file, 'articles', \Auth::id(), 1024);

            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }

    private function storeTags($tags, $article)
    {
        $tags_name = array_unique(explode(':', $tags));
        $existed_tags = Tag::whereIn('name', $tags_name)->get();
        $existed_tag_names = [];
        if($existed_tags->isNotEmpty())
        {
            foreach ($existed_tags as $existed_tag)
            {
                $existed_tag_names[] = $existed_tag->name;
                $article->tags()->attach($existed_tag->id);
            }
        }

        $diff_tags = array_diff($tags_name, $existed_tag_names);
        if(!empty($diff_tags)) {
            foreach ($diff_tags as $diff_tag) {
                $id = Tag::insertGetId(
                    ['name' => mb_strtolower($diff_tag)]
                );
                $article->tags()->attach($id);
            }
        }
    }

    public function destroy(Article $article)
    {
        $article->delete();
        $article->tags()->detach();
        $article->replies()->each(function ($item, $key)
        {
            Reply::where('id', $item->id)->delete();
        });

        return redirect()->route('admin.articles.index')->with('message', '删除成功');
    }

    public function create(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.create_and_edit', compact('article', 'categories'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->is_top = $request->is_top;
        $article->body = $request->body;

        $img_preg = '/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i';
        preg_match($img_preg, $article->body, $match);
        empty($match) ? $article->image = '' : $article->image = $match[1];

        $article->section_article = strip_tags(substr($article->body, 0, 200));
        $article->save();

        $this->storeTags($request->tags, $article);

        return redirect()->route('articles.show', $article->id)->with('message', '文章发布成功．');
    }

    public function batchDestroy(Request $request)
    {
        $article_ids = explode('&', $request->article_id);

        if(Reply::whereIn('article_id', $article_ids)->delete())
        {
            $res = Article::whereIn('id', $article_ids)->delete();
        }

        return response()->json(
            [
                'code' => 0,
                'message' => '删除了' . $res . '条数据'
            ]
        );
    }
}
