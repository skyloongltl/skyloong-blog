<div class="panel-body">
    <table class="table">
        <tr class="head">
            <td><input id="select_all" type="checkbox" name="page_number" value="select_all" onclick="selectAll()" aria-label="全选"></td>
            <td>ID</td>
            <td>Avatar</td>
            <td>Name</td>
            <td>Email</td>
            <td>Identity</td>
            <td>Operate</td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td><input type="checkbox" name="user_id" value="{{ $user->id }}"></td>
                <td>{{ $user->id }}</td>
                <td><img src="{{ $user->avatar }}" width="40px" height="40px"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @php
                        $names = [];
                        foreach ($user->getRoleNames() as $role) {
                            $names[] = $role;
                        }
                        echo $roles = implode(' | ', $names);
                    @endphp
                </td>
                <td>
                    <a type="button" class="btn btn-primary btn-sm"
                            onclick='userEdit("{{ $user->name }}", "{{ $user->email }}", "{{ $user->id }}", "{{ $roles }}")'> {{-- 这里用了单引号,结果因为名字里有单引号,结果不起作用 --}}
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm"
                            onclick="event.preventDefault();
                                    document.getElementById('destroy-{{ $user->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <form id="destroy-{{ $user->id }}"
                          action="{{ route('admin.users.destroy', [$user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

