@extends('admin.layouts.app')

@section('title', isset($article->id) ? '编辑文章' : '新建文章')

@section('content')

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h2 class="text-center">
                        <i class="glyphicon glyphicon-edit"></i>
                        @if($article->id)
                            编辑文章
                        @else
                            新建文章
                        @endif
                    </h2>

                    <hr>

                    @include('common.error')

                    @if($article->id)
                        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            @else
                                <form action="{{ route('admin.articles.store') }}" method="POST" accept-charset="UTF-8">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="tags" value="{{ old('tags', $article->tags_name ) }}" placeholder="请填写标签，用英文:分隔（或使用下面的标签）" required/>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="category_id" required>
                                            <option value="" hidden disabled {{ $article->id ? '' : 'selected' }}>请选择分类</option>
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->id }}" {{ $article->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="is_top" required>
                                            <option value="" hidden disabled selected>是否置顶</option>
                                            <option value="1" {{ $article->is_top == 1 ? 'selected' : '' }}>是</option>
                                            <option value="0" {{ $article->is_top == 0 ? 'selected' : '' }}>否</option>
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" required>{{ old('body', $article->body ) }}</textarea>
                                    </div>

                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.js') }}"></script>

    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('admin.articles.upload_image') }}',
                    params: { _token: '{{ csrf_token() }}' },
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>

@stop