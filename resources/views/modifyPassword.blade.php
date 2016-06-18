@extends('newMain')
@section('childCss')
    <link href="{{ URL::asset('css/userCenter.css')}}" type="text/css" rel="stylesheet"/>
    @stop
@section('realContent')
<div>
<ol class="breadcrumb">
  <li><a href="#">首页</a></li>
  <li><a href="#">个人中心</a></li>
</ol>
	<ul class="nav nav-pills nav-stacked" id="userCenterNav">
  <li role="presentation"><a href="../userCenter/info">基本资料</a></li>
  <li role="presentation" class="active"><a href="../userCenter/modifyPassword">密码修改</a></li>
  <li role="presentation"><a href="../userCenter/info">留言版</a></li>
  <li role="presentation"><a href="../userCenter/info">系统通知</a></li>
  <li role="presentation"><a href="../userCenter/info">好友管理</a></li>
	</ul>
	
	<div class="contentPanel">
    @section('content')
    @show
	</div>
</div>

<script>
	
</script>

@stop