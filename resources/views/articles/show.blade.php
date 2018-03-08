@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Article / Show #{{ $article->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('articles.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('articles.edit', $article->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Title</label>
<p>
	{{ $article->title }}
</p> <label>Body</label>
<p>
	{{ $article->body }}
</p> <label>Tags_id</label>
<p>
	{{ $article->tags_id }}
</p> <label>Category_id</label>
<p>
	{{ $article->category_id }}
</p> <label>Reply_count</label>
<p>
	{{ $article->reply_count }}
</p> <label>View_count</label>
<p>
	{{ $article->view_count }}
</p> <label>Is_top</label>
<p>
	{{ $article->is_top }}
</p> <label>Excerpt</label>
<p>
	{{ $article->excerpt }}
</p> <label>Slug</label>
<p>
	{{ $article->slug }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
