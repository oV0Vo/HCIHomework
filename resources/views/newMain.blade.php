<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href={{URL::asset('image/favicon.ico')}}>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
		
		<h1 class="header-nav"><a href="">运动广场</a></h1>
		<h1 class="header-nav"><a href="">健康数据</a></h1>
        <div class="search-container">
            <form action="../searchUser">
                <input type="text" id="search-input" name="key" placeholder=" 要搜索的人"/>
                <input id="searchType" hidden="hidden" name="pageType" value="2"/>
                <input id="searchType" hidden="hidden" name="value" value="0"/>
                <input class="btn search" type="submit" value="搜索"/>
            </form>
        </div>
        <li id="setting">
            <a href="javascript:void(0);">
				<span><img src="<?= Session::get("avatar")?>"/> <?= Session::get("nickname")?>呵</span>
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
                <a href="javascript:void(0);">健康数据</a>
                <ul>
                    <li><a href="../healthData">健康数据</a></li>
                    <li><a href="../healthPlan">我的计划</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">健康向导</a>
                <ul>
                    <li><a href="../healthAdvice">收到的建议</a></li>
                    <li><a href="../healthTeacher">健康导师</a></li>
                </ul>
            </li>

            <li><a href="../friend">我的朋友</a></li>

            <li>
                <a href="javascript:void(0);">健身活动</a>
                <ul>
                    <li><a href="../activity">查看活动</a></li>
                    <li><a href="../activity/publishActivity">发布活动</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<div id="content-container">
    <div id="main-content-container">
        @section('realContent')
        @show
    </div>

    <div id="hot-content-container">
        <div class="title2">热门活动</div>
        <a class="subContent2" href="javascript:alert('新功能正在研制当中~');">玄武湖步行</a>
        <br/>
        <br/>
        <br/>

        <div class="title2">最新活动</div>
        <a class="subContent2" href="javascript:alert('新功能正在研制当中~');">玄武湖步行</a>
    </div>
</div>
</body>
</html>