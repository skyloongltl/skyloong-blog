<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">
                Skyloong的博客
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ is_active('articles.index') }}"><a href="{{ route('articles.index') }}">首页</a></li>
                @foreach(\App\Models\Category::all() as $category)
                    <li class="{{ is_active('categories.show', [$category->id]) }}"><a href="{{ route('categories.show', [$category->id]) }}">{{ $category->name }}</a> </li>
                @endforeach
            </ul>
            {{--<ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('articles.index') }}">首页</a></li>
                <li><a href="{{ route('categories.show', 1) }}">PHP</a></li>
                <li><a href="{{ route('categories.show', 1) }}">Linux</a></li>
                <li><a href="{{ route('categories.show', 3) }}">前端</a></li>
                <li><a href="{{ route('categories.show', 4) }}">乱七八糟</a></li>
            </ul>--}}

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px;margin-top:-5px;">
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" style="min-width: 100%">
                            @can('manage_contents')
                                <li>
                                    <a href="{{ route('admin.home.index') }}">
                                        <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
                                        管理后台
                                    </a>
                                </li>
                            @endcan

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>