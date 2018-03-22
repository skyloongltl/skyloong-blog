<div class="panel-body">
    <table class="table">
        <tr class="head">
            <td><input id="select_all" type="checkbox" name="page_number"
                       value="select_all" onclick="selectAll()" aria-label="全选"></td>
            <td>ID</td>
            <td>Name</td>
            <td>guard_name</td>
            <td>Operate</td>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td><input type="checkbox" name="permission_id" value="{{ $permission->id }}"></td>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>
                    <a type="button" class="btn btn-primary btn-sm"
                       onclick='editPermission("{{ $permission->name }}", "{{ $permission->id }}", "{{ $permission->guard_name }}")'> {{-- 这里用了单引号,结果因为名字里有单引号,结果不起作用 --}}
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm"
                            onclick="event.preventDefault();
                                    document.getElementById('destroy-{{ $permission->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <form id="destroy-{{ $permission->id }}"
                          action="{{ route('admin.permissions.destroy', [$permission->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

