
@if(Cache::has('tags'))
<div class="panel panel-default">
    <div class="panel-body">
        <h4 style="margin-top:0px">热门标签</h4>
        <ul class="tag-list">
        @foreach(Cache::get('tags') as $tag)
            <li>
                <a href="{{ route('tags.show', [$tag->id]) }}" class="tag-name" style="background-color: {{ selectColor() }}">
                {{ $tag->name }}
                </a>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endif

@if(Cache::has('top_articles'))
<div class="panel panel-default">
    <div class=" panel-body">
        <h4 style="margin-top:0px">置顶推荐</h4>
            @foreach(Cache::get('top_articles') as $article)
                <div class="top-article">
                    <i class="glyphicon glyphicon-th-list"></i>
                    <a href="{{ route('articles.show', [$article->id]) }}">{{ $article->title }}</a>
                </div>
            @endforeach
    </div>
</div>
@endif

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
@stop

@section('scripts')
    <script type="text/javascript">
        var bottom=document.getElementById("btn-sw");
        bottom.onclick=function(){
            timer=setInterval(function(){
                var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
                var ispeed=Math.floor(-scrollTop/6);
                if(scrollTop == 0){
                    clearInterval(timer);
                }
                document.documentElement.scrollTop=document.body.scrollTop=scrollTop+ispeed;
            },30)
        };

        function fadeIn(el,time){
            if(el.style.opacity === ""){
                el.style.opacity = 0;
            }
            if(el.style.display === "" || el.style.display === 'none'){
                el.style.display = 'block';
            }

            var t = setInterval(function(){
                if(el.style.opacity < 1){
                    el.style.opacity = parseFloat(el.style.opacity)+0.01;
                }
                else{
                    clearInterval(t);
                }
            },time/100);
        }

        function fadeOut(el,time){
            if(el.style.opacity === ""){
                el.style.opacity = 1;
            }
            if(el.style.display === "" || el.style.display === 'none'){
                el.style.display = 'block';
            }

            var t = setInterval(function(){
                if(el.style.opacity > 0){
                    el.style.opacity = parseFloat(el.style.opacity)-0.01;
                }
                else{
                    clearInterval(t);
                    el.style.display = 'none'
                }
            },time/100);
        }

    </script>
@stop