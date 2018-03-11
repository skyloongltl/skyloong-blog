<div class="reply-list">
    @foreach($replies as $index => $reply)
        <div class="media" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="avatar pull-left">
                <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}" style="width:58px;height:58px;">
            </div>

            <div class="infos">
                <div class="media-heading">
                    <span>{{ $reply->user->name }}</span>
                    <span>  •  </span>
                    <span class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>

                    {{-- 删除回复按钮 --}}
                    @auth
                        {{-- TODO  验证是否有站长权限 --}}
                        @if(Auth::user())
                            <span class="meta pull-right">
                                <a title="删除回复">
                                     <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </span>
                        @endif
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