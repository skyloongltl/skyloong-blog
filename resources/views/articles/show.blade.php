@extends('layouts.app')

@section('title', $article->title ?? 'skyloong的博客')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-9 col-lg-9 col-md-9 col-sm-9 article-content">
            @include('articles._content', ['article' => $article])
        </div>

        <div class="col-xs-3 col-lg-3 col-md-9 col-sm-3 sidebar">
            @include('articles._sidebar')
        </div>
    </div>
</div>
@endsection
