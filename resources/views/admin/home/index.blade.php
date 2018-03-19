@extends('admin.layouts.app')

@section('content')

    <div class="row user-list">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-default">

                @if(isset($users))
                    <div class="panel-heading">
                        <h3 style="display: inline">
                            用户
                        </h3>
                        <span class="pull-right">
                            <a href="{{ route('register') }}" class="btn btn-primary">新建用户</a>
                            <a class="btn btn-primary" onclick="userFilter()">筛选</a>
                        </span>
                    </div>

                    <div class="operation">
                        <a class="btn btn-danger" id="deleteUser"><i class="fa fa-trash"></i> 批量删除</a>
                        <b>Total: {{ $users->total() }}</b>
                        <a href="{{ $users->previousPageUrl() }}" class="btn btn-default">上一页</a>
                        <a href="{{ $users->nextPageUrl() }}" class="btn btn-default">下一页</a>
                        <span>
                            <input id="page" type="text" name="page" value="{{ $users->currentPage() }}">
                        </span>
                        /
                        {{ ceil($users->total()/$users->page) }}
                        <a class="btn btn-default"
                           onclick="this.href='http://localhost:81/admin?page=' + document.getElementById('page').value">跳转</a>
                    </div>
                    @include('admin.home._user_list', ['users' => $users])
                @elseif(isset($roles))
                    <div class="panel-heading">
                        <h3 style="display: inline">
                            角色
                        </h3>
                        <span class="pull-right">
                            <a href="#" class="btn btn-primary">新建角色</a>
                            <a class="btn btn-primary">筛选</a>
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
                           onclick="this.href='http://localhost:81/admin?page=' + document.getElementById('page').value">跳转</a>
                    </div>
                    @include('admin.home._role_list', ['roles' => $roles])
                @elseif(isset($permissions))
                    <div class="panel-heading">
                        <h3 style="display: inline">
                            权限
                        </h3>
                        <span class="pull-right">
                            <a href="#" class="btn btn-primary">新建权限</a>
                            <a class="btn btn-primary">筛选</a>
                        </span>
                    </div>
                    <div class="operation">
                        <a class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
                        <b>Total: {{ $permissions->total() }}</b>
                        <a href="{{ $permissions->previousPageUrl() }}" class="btn btn-default">上一页</a>
                        <a href="{{ $permissions->nextPageUrl() }}" class="btn btn-default">下一页</a>
                        <span>
                            <input id="page" type="text" name="page" value="{{ $permissions->currentPage() }}">
                        </span>
                        /
                        {{ ceil($permissions->total()/$permissions->page) }}
                        <a class="btn btn-default"
                           onclick="this.href='http://localhost:81/admin?page=' + document.getElementById('page').value">跳转</a>
                    </div>
                    @include('admin.home._permissions_list', ['permissions' => $permissions])
                @endif
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
        var allBox = document.getElementsByName("user_id");

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

        function batchDelete() {
            var userArr = new Array();
            for (var i = 0; i < allBox.length; i++) {
                userArr.push(allBox[i].value);
            }

            var str = userArr.join("&");

            $.ajax({

            })
        }

        function userFilter() {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '               <div class="panel-heading">\n' +
                '                    <h3>筛选</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <form action="" method="POST">\n' +
                    '<input type="hidden" name="_method" value="PUT">' +
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '                        <b>用户ID:</b>\n' +
                '                        <input type="text" id="user_id" name="user_id" class="form-control">\n' +
                '                        <b>昵称:</b>\n' +
                '                        <input type="text" id="user_name" name="user_name" class="form-control">\n' +
                '                        <b>邮箱:</b>\n' +
                '                        <input type="text" id="email" name="email" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button type="submit" class="btn btn-primary">搜索</button>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '</div>'
        }

        function userEdit(name, email) {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>筛选</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <form action="" method="POST">\n' +
                '<input type="hidden" name="_method" value="PUT">' +
                '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '                        <b>昵称:</b>\n' +
                '                        <input type="text" id="user_name" name="user_name" class="form-control" value="' + name + '">\n' +
                '                        <b>邮箱:</b>\n' +
                '                        <input type="text" id="email" name="email" class="form-control" value="' + email + '">\n' +
                '                        <b>密码:</b>\n' +
                '                        <input type="password" id="password" name="password" class="form-control">\n' +
                '                        <b>确认密码:</b>\n' +
                '                        <input type="password" id="repassword" name="repassword" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button type="submit" class="btn btn-primary">修改</button>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '            </div>'
        }
    </script>
@stop