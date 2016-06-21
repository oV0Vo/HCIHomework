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
		<h2>密码修改</h2>
		<form>
		<span class="lineHead">旧密码</span><input id="oldPassword"type="text"><span id="oldPassHint"></span>
		<br/>
		<span class="lineHead">新密码</span><input id="newPassword"type="text">
		<br/>
		<span class="lineHead">密码确认</span><input id="newPassConfirm"type="text"><span id="newPassHint"></span>
		<br/>
		<br/>
		<a class="btn btn-default" id="submit">更改密码</a>
		</form>
		
	</div>
</div>

<script>
        $(document).ready(function () {
            $("#signUpSummit").click(function () {
				alert('更改密码');
            });
        })
</script>

@stop