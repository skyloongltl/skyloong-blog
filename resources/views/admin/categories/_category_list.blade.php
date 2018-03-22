<div class="panel-body">
    <table class="table">
        <tr class="head">
            <td class="col-lg-1"> <input id="select_all" type="checkbox" name="page_number"
                       value="select_all" onclick="selectAll()" aria-label="全选"></td>
            <td class="col-lg-1">ID</td>
            <td class="col-lg-3">Name</td>
            <td class="col-lg-3">Operate</td>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td><input type="checkbox" name="category_id" value="{{ $category->id }}"></td>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a type="button" class="btn btn-primary btn-sm"
                       onclick='editCategory("{{$category->name}}", "{{ $category->id }}")'> {{-- 这里用了单引号,结果因为名字里有单引号,结果不起作用 --}}
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm"
                            onclick="event.preventDefault();
                                    document.getElementById('destroy-{{ $category->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <form id="destroy-{{ $category->id }}"
                          action="{{ route('admin.categories.destroy', [$category->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

