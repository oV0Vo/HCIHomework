<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href={{URL::asset('image/favicon.ico')}}>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{ URL::asset('css/main.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{ URL::asset('css/util.css')}}" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">	
	<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
	@section('childCss')
    @show
</head>
<body>
<nav class="navbar">
	<ul class="nav navbar-nav head">
		<li role="presentation"><a href="../activity">活动广场</a></li>
		<li role="presentation"><a href="../healthData">健康管理</a></li>
	</ul>
	
	<form class="navbar-form navbar-right" role="search">
	
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入活动标题或内容">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>  
			
			
	  <img src="http://7xpcat.com1.z0.glb.clouddn.com/1451286513/tmp/phpbSVAr8?e=3598770160&token=hdZdapjcdEK2vbVKTo--ETEciepTc9Eqs12BKS7T:nBhvCFb-oI8WZ3yoT11lHnky70Q="
	  alt="头像" class="img-round-small nav">
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Hermitter2 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="../userCenter/info">个人中心</a></li>
    <li><a href="../notice">系统消息</a></li>
    <li><a href="../logout">注销</a></li>
	</ul>
</div>
      </form>  
</nav>
	<div id="mainContent">
    @section('realContent')
    @show</div>
</body>
</html>
