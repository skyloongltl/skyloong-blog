@if(count($articles))
    <ul class="article-list">
        @foreach($articles as $article)
            <li class="row panel panel-default">
                <dvi class="col-xs-12 col-md-12 col-lg-12">
                    <div class="panel-heading">
                        <h2><a href="{{ route('articles.show', [$article->id]) }}">{{ $article->title }}</a></h2>
                    </div>
                </dvi>

                <div class="col-xs-12 col-md-12 col-lg-12">
                    <ul class="row">
                        <li class="col-xs-5 col-md-2 col-lg-3">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <span>skyloong</span>
                        </li>
                        <li class="col-xs-7 col-md-3 col-lg-3">
                            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            <span class="timeago" title="创建时间">{{ $article->updated_at }}</span>
                        </li>
                        <li class="col-xs-5 col-md-2 col-lg-2">
                            <a href="{{ route('categories.show', [$article->category->id]) }}" title="{{ $article->category->name }}">
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

                <div class="col-xs-12 col-md-12 col-lg-12">
                    <div class="row panel-body">
                        <div class="row media">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <div class="media-left">
                                    <a href="{{ route('articles.show', [$article->id]) }}">
                                        <img class="media-object img-thumbnail" style="width: 180px; height: 150px"
                                             src="{{ $article->image }}" title="" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-9 col-sm-12">
                                <div class="media-body">
                                    <div class="media-heading">
                                        <p>
                                          {{ $article->section_article }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('articles.show', [$article->id]) }}">阅读全文</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="empty-block">还没有发布文章~_~</div>
@endif
