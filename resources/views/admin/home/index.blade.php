@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="display: inline">
                        @if(isset($users))
                            用户
                        @elseif(isset($roles))
                            角色
                        @else
                            权限
                        @endif
                    </h3>
                    <a>新建</a>
                    <a>筛选</a>
                </div>
                <div class="panel-body">
                    <table class="table">
                        @if(isset($users))
                            <tr class="head">
                                <td><input type="checkbox" name="page_number" value="" aria-label="全选"></td>
                                <td>ID</td>
                                <td>Avatar</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Operate</td>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td><input type="checkbox" name="user_id" value="{{ $user->id }}"></td>
                                    <td>{{ $user->id }}</td>
                                    <td><img src="{{ $user->avatar }}" width="40px" height="40px"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm">
                                            <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault();
                                                    document.getElementById('destroy-{{ $user->id }}').submit();">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        <form id="destroy-{{ $user->id }}" action="{{ route('admin.users.destroy', [$user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            {!! $users->render() !!}
        </div>

        <div class="col-lg-4 hidden-md hidden-sm">

        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
@stop