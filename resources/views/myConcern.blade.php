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
		<h2>好友管理</h2>
		<ul class="nav nav-tabs">
		  <li role="presentation"><a href="#">粉丝</a></li>
		  <li role="presentation" class="active"><a href="#">关注</a></li>
		</ul>
		<ul class="nav nav-pills">
		  <li id="desc" role="presentation" onclick="window.location.href = '/userCenter/myConcern?asc=0&page=0'"
		  <?=!$asc?"class='active'": ""?>><a href="#">最近关注</a></li>
		  <li id="asc" role="presentation"  onclick="window.location.href = '/userCenter/myConcern?asc=1&page=0'"
		  <?=$asc?"class='active'": ""?>><a href="#">最早关注</a></li>
		</ul>
		@if (count($users) != 0)
			@for($i=0; $i < count($users) - 1; $i+=2)
			<?php $user = $users[$i]?>
			<a href='#'>
			<img class='img round' src={{$user->avatar or URL::asset('image/default_user_avatar.jpg')}} 
				alt='用户头像'/>
			<span class='title'>{{$user->nickname or '无名氏'}}</span>
			</a>
			<?php $user = $users[$i + 1]?>
			<a href='#'>
			<img class='img round' src={{$user->avatar or URL::asset('image/default_user_avatar.jpg')}} 
				alt='用户头像'/>
			<span class='title'>{{$user->nickname or '无名氏'}}</span>
			</a>
			<br/>
			@endfor
			@if ($i == count($users) - 1)
			<?php $user = $users[$i]?>
			<a href='#'>
			<img class='img round' src={{$user->avatar or URL::asset('image/default_user_avatar.jpg')}} 
				alt='用户头像'/>
			<span class='title'>{{$user->nickname or '无名氏'}}</span>
			</a>
			<br/>
			@endif
		@include('nav', array('currentPage' => Request::get('page'), 'itemCount' => count($users), 
				'pageUrl' => '../userCenter/myConcern?page='))
		@else
			hehe，没有数据
		@endif
	</div>
</div>

@stop