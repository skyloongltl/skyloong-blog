<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(ReplyRequest $request, Reply $reply)
	{
	    $reply->content = $request->content;
		//preg_match_all("|@[\w\x{4e00}-\x{9fa5}]+|u", $request->content, $match);
		$reply->user_id = Auth::id();
		$reply->article_id = $request->article_id;
		$reply->save();

		return redirect()->route('articles.show', $request->article_id)->with('message', '回复成功');
	}

	public function destroy(Request $request, Reply $reply)
	{
		//$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->route('articles.show', $reply->article->id)->with('message', '删除成功');
	}

}