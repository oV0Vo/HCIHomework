<!DOCTYPE html>
<html>
    <head>
        <title>没有名字的网站</title>
        @section("childHead")
            @show
        <link rel="shortcut icon" type="image/x-icon" href={{URL::asset('image/favicon.ico')}}>
        <link rel="stylesheet" type="text/css" href={{URL::asset('css/util.css')}}/>
        <link rel="stylesheet" type="text/css" href={{URL::asset('css/indexMain.css')}}/>
        @section('childCss')
            @show
        <script src="{{ URL::asset('js/jquery.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <div id="head-bar">
                <a href="../index" id="head-icon">
                    <img src="../image/head.png"/>
                </a>
                <a class="btn btn-primary" href="../signUpIndex">注册</a>
                <a class="btn" href="../signInIndex">登录</a>
                </div>
            </div>
        </header>
    @section("mainContent")
        @show
    </body>
</html>
