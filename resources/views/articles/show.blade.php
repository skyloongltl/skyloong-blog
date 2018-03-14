@extends('layouts.app')

@section('title', $article->title ?? 'skyloong的博客')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-8 col-md-8 col-sm-12 article-content">
            @include('articles._content', ['article' => $article])

            <div class="row panel panel-default article-reply">
                <div class="panel-body">
                    @includeWhen(Auth::check(), 'articles._reply_box', ['article' => $article])
                    @include('articles._reply_list', ['replies' => $article->replies()->with('user')->get()])
                </div>
            </div>
        </div>

        <div class="hidden-xs col-lg-4 col-md-4 hidden-sm sidebar">
            @include('articles._sidebar')
        </div>
    </div>
</div>
@endsection
