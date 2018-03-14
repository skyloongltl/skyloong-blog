@extends('layouts.app')

@section('title', isset($category) ? $category->name : '首页')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12 article-list">

            {{-- 话题列表 --}}
            @include('articles._article_list', ['articles' => $articles])

            {{-- 分页 --}}
            {!! $articles->render() !!}
        </div>

        <div class="col-lg-4 col-md-4 hidden-xs hidden-sm sidebar">
            @include('articles._sidebar')
        </div>
    </div>
@endsection
