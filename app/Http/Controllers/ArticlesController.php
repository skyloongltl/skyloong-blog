<?php

namespace App\Http\Controllers;

use App\Models\Article;
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

	public function create(Article $article)
	{
	    $categories = Category::all();
		return view('articles.create_and_edit', compact('article', 'categories'));
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

	    $article->section_article = substr($article->body, 0, 200);
	    $article->save();

	    $tags_name = array_unique(explode(':', $request->tags));
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
	    foreach ($diff_tags as $diff_tag)
        {
            $id = Tag::insertGetId(
                ['name' => mb_strtolower($diff_tag)]
            );
            $article->tags()->attach($id);
        }

		return redirect()->route('articles.show', $article->id)->with('message', '文章发布成功．');
	}

	public function edit(Article $article)
	{
        $this->authorize('update', $article);
        $categories = Category::all();
        return view('articles.create_and_edit', compact('article', 'categories'));
	}

	public function update(ArticleRequest $request, Article $article)
	{
		$this->authorize('update', $article);
		$article->update($request->all());

		return redirect()->route('articles.show', $article->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Article $article)
	{
		$this->authorize('destroy', $article);
		$article->delete();

		return redirect()->route('articles.index')->with('message', 'Deleted successfully.');
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

}