<div class="panel-body">
    <table class="table">
        <tr class="head">
            <td><input id="select_all" type="checkbox" name="page_number" value="select_all" onclick="selectAll()" aria-label="全选"></td>
            <td>ID</td>
            <td>Name</td>
            <td>Permissions</td>
            <td>Operate</td>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td><input type="checkbox" name="role_id" value="{{ $role->id }}"></td>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @php
                        $names = [];
                        $ids = [];
                        foreach ($role->permissions as $permission){
                            $names[] = $permission->name;
                            $ids[] = $permission->id;
                        }
                        $role->permission =  implode(' | ', $names);
                        echo $role->permission;
                    @endphp
                </td>
                <td>
                    <a type="button" class="btn btn-primary btn-sm"
                       onclick='editRole("{{ $role->name }}", "{{ $role->permission }}", "{{ $role->id }}")'> {{-- 这里用了单引号,结果因为名字里有单引号,结果不起作用 --}}
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm"
                            onclick="event.preventDefault();
                                    document.getElementById('destroy-{{ $role->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <form id="destroy-{{ $role->id }}"
                          action="{{ route('admin.roles.destroy', [$role->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

