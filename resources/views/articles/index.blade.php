@extends('layouts.app')

@section('title', '首页')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 article-list">
            {{-- 话题列表 --}}
            @include('articles._article_list', ['articles' => $articles])

            {{-- 分页 --}}
            {!! $articles->render() !!}
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 sidebar">
            @include('articles._sidebar')
        </div>
    </div>
@endsection
