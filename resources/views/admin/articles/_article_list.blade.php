<div class="panel-body">
    <table class="table">
        <tr class="head">
            <td>
                <input id="select_all" type="checkbox" name="page_number"
                       value="select_all" onclick="selectAll()" aria-label="全选">
            </td>
            <td class="col-lg-1 col-md-1 col-sm-1">id</td>
            <td class="col-lg-4 col-md-4 col-sm-4">title</td>
            <td class="col-lg-1 col-md-1 col-sm-1">is_top</td>
            <td class="col-lg-2 col-md-2 col-sm-2">created_at</td>
            <td class="col-lg-2 col-md-2 col-sm-2">updated_at</td>
            <td class="col-lg-2 col-md-2 col-sm-2">operate</td>
        </tr>
        @foreach($articles as $article)
            <tr>
                <td><input type="checkbox" name="article_id" value="{{ $article->id }}"></td>
                <td>{{ $article->id }}</td>
                <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                <td>{{ $article->is_top }}</td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->updated_at }}</td>
                <td>
                    <a type="button" class="btn btn-primary btn-sm"
                       href="{{ route('admin.articles.edit', $article->id) }}">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm"
                            onclick="event.preventDefault();
                                    document.getElementById('destroy-{{ $article->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <form id="destroy-{{ $article->id }}"
                          action="{{ route('admin.articles.destroy', [$article->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>