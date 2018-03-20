<nav class="nav navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">后台管理</a>
        </div>

        <div class="collapse navbar-collapse" id="admin-navbar-collpase">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        用户与权限
                        <sapn class="caret"></sapn>
                    </a>
                    <ul class="dropdown-menu" style="min-width: 100%">
                        <li>
                            <a href="{{ route('admin.home.index') }}">
                                用户
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="{{ route('admin.roles.index') }}">
                                角色
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="{{ route('admin.permissions.index') }}">
                                权限
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        内容管理
                        <sapn class="caret"></sapn>
                    </a>
                    <ul class="dropdown-menu" style="min-width: 100%">
                        <li>
                            <a href="#">
                                文章
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#">
                                分类
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#">
                                标签
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="#">站点管理</a></li>
            </ul>
        </div>
    </div>
</nav>