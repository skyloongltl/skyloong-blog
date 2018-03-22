@extends('admin.layouts.app')

@section('content')
    <div class="row list">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="display: inline">
                        角色
                    </h3>
                    <span class="pull-right">
                            <a onclick="createRole()" class="btn btn-primary">新建角色</a>
                            <a onclick="filterRole()" class="btn btn-primary">筛选</a>
                        </span>
                </div>
                <div class="operation">
                    <a class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
                    <b>Total: {{ $roles->total() }}</b>
                    <a href="{{ $roles->previousPageUrl() }}" class="btn btn-default">上一页</a>
                    <a href="{{ $roles->nextPageUrl() }}" class="btn btn-default">下一页</a>
                    <span>
                            <input id="page" type="text" name="page" value="{{ $roles->currentPage() }}">
                    </span>
                    /
                    {{ ceil($roles->total()/$roles->page) }}
                    <a class="btn btn-default"
                       onclick="this.href='http://localhost:81/admin/roles?page=' + document.getElementById('page').value">跳转</a>
                </div>
                @include('admin.home._role_list', ['roles' => $roles])
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
        var allBox = document.getElementsByName("role_id");

        function selectAll() {
            var all = document.getElementById("select_all");

            if(all.checked) {
                for (var i = 0; i < allBox.length; i++) {
                    if(allBox[i].type == 'checkbox') {
                        allBox[i].checked = true;
                    }
                }
            } else {
                for (var i = 0; i < allBox.length; i++) {
                    if(allBox[i].type == 'checkbox') {
                        allBox[i].checked = false;
                    }
                }
            }
        }
        //Roles
        function editRole(name, permissions, id){
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>编辑</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                <div id="edit-role">' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '                        <input type="hidden" name="role_id" value="' + id + '">' +
                '                        <b>Role Name</b>\n' +
                '                        <input type="text" name="role_name" value="' + name + '" class="form-control">\n' +
                '                        <b>Permissions</b>\n' +
                '                        <input type="text" name="permissions" value="' + permissions + '" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button onclick="updateRole()" type="submit" class="btn btn-primary">修改</button>\n' +
                '                </div>\n' +
                '            </div>';
        }
        
        function updateRole() {
                var data = $("#edit-role").find("input").map(function () {
                    return ($(this).attr("name") + '=' + $(this).val());
                }).get().join("&");

                $.ajax({
                    url: '{{ route('admin.roles.update') }}',
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

        function filterRole() {
            document.getElementById('sidebar').innerHTML =
                ' <div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>筛选</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <form action="{{ route("admin.roles.search") }}" method="POST">\n' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                '                        <b>ID</b>\n' +
                '                        <input type="text" name="role_id" value="" class="form-control">\n' +
                '                        <b>Name</b>\n' +
                '                        <input type="text" name="role_name" value="" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button class="btn btn-primary" type="submit">搜索</button>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '            </div>'
        }

        function createRole() {
            document.getElementById('sidebar').innerHTML =
                ' <div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>新建角色</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <form action="{{ route("admin.roles.store") }}" method="POST">\n' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '                        <b>name</b>\n' +
                '                        <input type="text" name="role_name" value="" class="form-control">\n' +
                '                        <b>guard_name</b>\n' +
                '                        <input type="text" name="guard_name" value="web" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button type="submit" class="btn btn-primary">提交</button>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '            </div>'
        }
    </script>
@stop