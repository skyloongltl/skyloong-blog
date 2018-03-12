<div class="row panel panel-default">
    <div class="panel-body">
        <h1 class="text-center">
            {{ $article->title }}
        </h1>

        <div class="col-xs-12 col-lg-12 col-sm-12 article-meta text-center">
            <ul class="row">
                <li class="col-xs-5 col-md-2 col-lg-3">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <span>skyloong</span>
                </li>
                <li class="col-xs-7 col-md-3 col-lg-3">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    <span class="timeago" title="创建时间">{{ $article->created_at }}</span>
                </li>
                <li class="col-xs-5 col-md-2 col-lg-2">
                    <a href="{{ route('categories.show', [$article->category->id]) }}"
                       title="{{ $article->category->name }}">
                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                        {{ $article->category->name }}
                    </a>
                </li>
                <li class="col-xs-7 col-md-5 col-lg-4">
                    <a href="#">
                        <span class="glyphicon glyphicon-tag"></span>
                        @foreach($article->tags as $tag)
                            {{ $tag->name }}
                            &nbsp;
                        @endforeach
                    </a>
                </li>
            </ul>
        </div>

        <div class="article-body">
            {!! $article->body !!}
        </div>

        <div class="operate">
            <hr>
            <div class="prev">
                <span class="btn btn-default btn-xs" role="button"　disabled="disabled">
                    上一篇
                </span>
                :
                @if(isset($prev_article))
                    <a href="{{ route('articles.show', [$prev_article->id]) }}">
                        {{ $prev_article->title }}
                    </a>
                @else
                    <span>没有了</span>
                @endif
            </div>
            <br>
            <div class="next" id="next">
                <span class="btn btn-default btn-xs" role="button" disabled="disabled">
                    下一篇
                </span>
                :
                @if(isset($next_article))
                    <a href="{{ route('articles.show', [$next_article->id]) }}">
                        {{ $next_article->title }}
                    </a>
                @else
                    <span>没有了</span>
                @endif
            </div>

        </div>
    </div>
</div>