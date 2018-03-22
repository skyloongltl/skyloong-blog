@extends('admin.layouts.app')

@section('content')

    <div class="row list">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="display: inline">
                        文章
                    </h3>
                    <span class="pull-right">
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">发表文章</a>
                            <a class="btn btn-primary">搜索</a>
                    </span>
                </div>

                <div class="operation">
                    <a class="btn btn-danger" id="deleteUser" onclick="batchDelete()"><i class="fa fa-trash"></i>
                        批量删除</a>
                    <b>Total: {{ $articles->total() }}</b>
                    <a href="{{ $articles->previousPageUrl() }}" class="btn btn-default">上一页</a>
                    <a href="{{ $articles->nextPageUrl() }}" class="btn btn-default">下一页</a>
                    <span>
                            <input id="page" type="text" name="page" value="{{ $articles->currentPage() }}">
                        </span>
                    /
                    {{ ceil($articles->total()/$articles->page) }}
                    <a class="btn btn-default"
                       onclick="this.href='http://localhost:81/admin/articles?page=' + document.getElementById('page').value">跳转</a>
                </div>
                @include('admin.articles._article_list')
            </div>
        </div>

        <div id="sidebar" class="col-lg-4 hidden-md hidden-sm">

        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
@stop

@section('scripts')
<script type="text/javascript">
    var allBox = document.getElementsByName("article_id");

    function selectAll() {
        var all = document.getElementById("select_all");

        if (all.checked) {
            for (var i = 0; i < allBox.length; i++) {
                if (allBox[i].type == 'checkbox') {
                    allBox[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < allBox.length; i++) {
                if (allBox[i].type == 'checkbox') {
                    allBox[i].checked = false;
                }
            }
        }
    }

    function batchDelete() {
        var userArr = new Array();
        var all = document.getElementById("select_all");
        if (all.checked) {
            for (var i = 0; i < allBox.length; i++) {
                userArr.push(allBox[i].value);
            }
        } else {
            for (var i = 0; i < allBox.length; i++) {
                if (allBox[i].checked) {
                    userArr.push(allBox[i].value);
                }
            }
        }


        var str = userArr.join("&");
        $.ajax({
            url: '{{ route('admin.articles.batch-destroy') }}',
            type: 'POST',
            async: true,
            data: {
                _token: '{{ csrf_token() }}',
                article_id: str
            },
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.code === 'true') {
                    location.reload();
                } else {
                    alert(data.message);
                }
            },
            error: function (xhr, textStatus) {
                console.log('error');
                console.log(xhr)
                console.log(textStatus)

            }
        })
    }
</script>
@stop