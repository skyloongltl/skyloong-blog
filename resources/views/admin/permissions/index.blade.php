@extends('admin.layouts.app')

@section('content')
    <div class="row user-list">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="display: inline">
                        权限
                    </h3>
                    <span class="pull-right">
                            <a onclick="createPermission()" class="btn btn-primary">新建权限</a>
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
                @include('admin.permissions._permissions_list', ['permissions' => $permissions])
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
        function editPermission(name, id, guard_name) {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>编辑</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <div id="edit-permission">\n' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                '                        <input type="hidden" name="permission_id" value="' + id + '" class="form-control">\n' +
                '                        <b>Name</b>\n' +
                '                        <input type="text" name="permission_name" value="' + name + '" class="form-control">\n' +
                '                        <b>guard_name</b>\n' +
                '                        <input type="text" name="guard_name" value="' + guard_name + '" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button onclick="updatePermission()" class="btn btn-primary">编辑</button>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>'
        }
        
        function updatePermission() {
            var data = $('#edit-permission').find('input').map(function () {
                return ($(this).attr("name") + '=' + $(this).val());
            }).get().join("&");

            $.ajax({
                url: '{{ route('admin.permissions.update') }}',
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
        
        function createPermission() {
            document.getElementById('sidebar').innerHTML =
                '<div class="panel">\n' +
                '                <div class="panel-heading">\n' +
                '                    <h3>新建权限</h3>\n' +
                '                </div>\n' +
                '                <div class="panel-body">\n' +
                '                    <form action="{{ route("admin.permissions.store") }}" method="POST">\n' +
                '                        <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                '                        <b>Name</b>\n' +
                '                        <input type="text" name="permission_name" value="" class="form-control">\n' +
                '                        <b>guard_name</b>\n' +
                '                        <input type="text" name="guard_name" value="web" class="form-control">\n' +
                '                        <br>\n' +
                '                        <button type="submit" class="btn btn-primary">添加</button>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '            </div>'
        }
    </script>
@stop