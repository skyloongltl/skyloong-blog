@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Article
                    <a class="btn btn-success pull-right" href="{{ route('articles.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($articles->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Title</th> <th>Body</th> <th>Tags_id</th> <th>Category_id</th> <th>Reply_count</th> <th>View_count</th> <th>Is_top</th> <th>Excerpt</th> <th>Slug</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="text-center"><strong>{{$article->id}}</strong></td>

                                    <td>{{$article->title}}</td> <td>{{$article->body}}</td> <td>{{$article->tags_id}}</td> <td>{{$article->category_id}}</td> <td>{{$article->reply_count}}</td> <td>{{$article->view_count}}</td> <td>{{$article->is_top}}</td> <td>{{$article->excerpt}}</td> <td>{{$article->slug}}</td>
                                    
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('articles.show', $article->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a>
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('articles.edit', $article->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $articles->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection