<!DOCTYPE html>
<html>
   <head>
       <link rel="shortcut icon" type="image/x-icon" href={{URL::asset('image/favicon.ico')}}>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link href="{{ URL::asset('css/main.css')}}" type="text/css" rel="stylesheet"/>
       <link href="{{ URL::asset('css/util.css')}}" type="text/css" rel="stylesheet"/>
       <script src="{{ URL::asset('js/jquery.js')}}" type="text/javascript"></script>
       @section('childCss')
       @show
   </head>
   <body>
        <header>
            <div id="head-bar">
                <a href="../index" id="head-icon">
                    <img src="../image/head.png"/>
                </a>
                <div class="search-container">
                    <form action="searchUser">
                        <input type="text" id="search-input" name="search_key" placeholder=" 要搜索的人"/>
                        <a class="btn" href="../searchUser">搜索</a>
                    </form>
                </div>
                <li id="setting">
                    <a href="javascript:void(0);">
                        <img src="{{URL::asset('image/setting.png')}}"/>
                    </a>
                    <ul>
                        <li><a href="../setting">资料设置</a></li>
                        <li><a href="../exitLogin">退出登录</a></li>
                    </ul>
                </li>
            </div>
            <nav>
                <ul id="main-menu">
                    <li>
                        <a href="../userManage">用户管理</a>
                    </li>

                    <li>
                        <a href="../userPriorityManage">权限管理</a>
                    </li>
                    <li>
                        <a href="../activity/manage">活动管理</a>
                    </li>
                </ul>
            </nav>
        </header>

        <div id="content-container">
            <div id="main-content-container">
                @section('realContent')
                @show
            </div>
        </div>
   </body>
</html>
