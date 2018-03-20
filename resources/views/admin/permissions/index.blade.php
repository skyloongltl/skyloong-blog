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
            </div>
        </div>

        <div id="sidebar" class="col-lg-4 hidden-md hidden-sm">

        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
@stop