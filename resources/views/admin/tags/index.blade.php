@extends('admin.layouts.app')

@section('content')
<div class="row list">
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 style="display: inline">
                    分类
                </h3>
                <span class="pull-right">
                            <a onclick="createTag()" class="btn btn-primary">新建标签</a>
                            <a class="btn btn-primary">筛选</a>
                        </span>
            </div>

            <div class="operation">
                <a class="btn btn-danger" id="deleteCategories" onclick="batchDelete()">
                    <i class="fa fa-trash"></i>
                    批量删除
                </a>
                <b>Total: {{ $tags->total() }}</b>
                <a href="{{ $tags->previousPageUrl() }}" class="btn btn-default">上一页</a>
                <a href="{{ $tags->nextPageUrl() }}" class="btn btn-default">下一页</a>
                <span>
                      <input id="page" type="text" name="page" value="{{ $tags->currentPage() }}">
                </span>
                /
                {{ ceil($tags->total()/$tags->page) }}
                <a class="btn btn-default"
                   onclick="this.href='http://localhost:81/admin/tags?page=' + document.getElementById('page').value">跳转</a>
            </div>
            @include('admin.tags._tag_list', ['tags' => $tags])
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
        var allBox = document.getElementsByName("tag_id");

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
                url: '{{ route('admin.tags.batch-destroy') }}',
                type: 'POST',
                async: true,
                data: {
                    _token: '{{ csrf_token() }}',
                    tag_ids: str
                },
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (!data.code) {
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

        function createTag() {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '            <div class="panel-heading">\n' +
                '                <h3>新建</h3>\n' +
                '            </div>\n' +
                '            <div class="panel-body">\n' +
                '                <form action="{{ route("admin.tags.store") }}" method="POST">\n' +
                '                    <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                '                    <b>Name</b>\n' +
                '                    <input type="text" name="name" value="" class="form-control">\n' +
                '                    <br>\n' +
                '                    <button type="submit" class="btn btn-primary">提交</button>\n' +
                '                </form>\n' +
                '            </div>\n' +
                '        </div>';
        }
    </script>
@stop