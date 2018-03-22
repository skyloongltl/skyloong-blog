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
                            <a onclick="createCategory()" class="btn btn-primary">新建分类</a>
                            <a class="btn btn-primary">筛选</a>
                        </span>
                </div>

                <div class="operation">
                    <a class="btn btn-danger" id="deleteCategories" onclick="batchDelete()">
                        <i class="fa fa-trash"></i>
                        批量删除
                    </a>
                    <b>Total: {{ $categories->total() }}</b>
                    <a href="{{ $categories->previousPageUrl() }}" class="btn btn-default">上一页</a>
                    <a href="{{ $categories->nextPageUrl() }}" class="btn btn-default">下一页</a>
                    <span>
                            <input id="page" type="text" name="page" value="{{ $categories->currentPage() }}">
                        </span>
                    /
                    {{ ceil($categories->total()/$categories->page) }}
                    <a class="btn btn-default"
                       onclick="this.href='http://localhost:81/admin/categories?page=' + document.getElementById('page').value">跳转</a>
                </div>
                @include('admin.categories._category_list', ['categories' => $categories])
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
        var allBox = document.getElementsByName("category_id");

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
                url: '{{ route('admin.categories.batch-destroy') }}',
                type: 'POST',
                async: true,
                data: {
                    _token: '{{ csrf_token() }}',
                    category_ids: str
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

        function editCategory(name, id) {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>编辑</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <div id="edit-category">\n' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                    '<input type="hidden" name="category_id" value="' + id + '">' +
                '                        <b>Name:</b>\n' +
                '                        <input type="text" name="category_name" value="' + name + '" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button onclick="updateCategory()" class="btn btn-primary">提交</button>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>';
        }

        function updateCategory(){
            var data = $("#edit-category").find("input").map(function () {
                return ($(this).attr("name") + '=' + $(this).val());
            }).get().join("&");

            $.ajax({
                url: '{{ route('admin.categories.update') }}',
                type: 'POST',
                async: true,
                data: data,
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if(!data.code) {
                        location.reload();
                    }else {
                        alert(data.message);
                    }
                    console.log(textStatus);
                },
                error: function (xhr, textStatus) {
                    console.log(xhr);
                    console.log(textStatus);
                    console.log('error');
                }
            });
        }

        function createCategory() {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>新建分类</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <form action="{{ route("admin.categories.store") }}" method="POST">\n' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                '                        <b>Name</b>\n' +
                '                        <input type="text" name="category_name" value="" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button type="submit" class="btn btn-primary">新建</button>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '            </div>';
        }
    </script>
@stop