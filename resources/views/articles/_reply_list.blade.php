<div class="reply-list">
    @foreach($replies as $index => $reply)
        <div class="media" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="avatar pull-left col-xs-1 col-lg-1">
                <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}" style="width:58px;height:58px;">
            </div>

            <div class="infos col-xs-11 col-lg-11">
                <div class="media-heading">
                    <span>{{ $reply->user->name }}</span>
                    <span>  •  </span>
                    <span class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>

                    {{-- 删除回复按钮 --}}
                    @auth
                            <span class="meta pull-right">
                                <a href="#next"
                                   onclick="document.getElementById('reply-textarea').value += '@' + '{{ $reply->user->name }}' + ' '"
                                   title="回复">
                                     <i class="fa fa-reply" aria-hidden="true"></i>
                                </a>
                            </span>
                        @can('destroy', $reply)
                            <span class="meta pull-right point">
                                <span>&nbsp;•&nbsp;</span>
                            </span>
                            <span class="meta pull-right">
                                <a href="{{ route('replies.destroy', [$reply->id]) }}"
                                   onclick="event.preventDefault();
                                                document.getElementById('trash-form-{{ $reply->id }}').submit();">
                                        <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <form id="trash-form-{{ $reply->id }}" action="{{ route('replies.destroy', [$reply->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </span>
                        @endcan
                    @endauth
                </div>
                <div class="reply-content">
                    {!! $reply->content !!}
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
@stop