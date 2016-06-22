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
  <li role="presentation"><a href="../userCenter/modifyPassword">密码修改</a></li>
  <li role="presentation" class="active"><a href="../userCenter/info">留言版</a></li>
  <li role="presentation"><a href="../userCenter/info">系统通知</a></li>
  <li role="presentation"><a href="../userCenter/info">好友管理</a></li>
	</ul>
	
	<div class="contentPanel">
		<h2>留言板</h2>
		<?php 
			for($i=0; $i<count($comments); ++$i) {
				$comment = $comments[$i];?>
			<div class="commentItem">
				<div class="commentHead">
				<a href='#'><img src=<?= $comment->authorAvatar?> class="img round" style="float:left" alt="好友头像"/></a>
				<a href='#'><span class="title"><?= $comment->authorName?></span></>
				<div><?= $comment->commentTime?></div>
				</div>
				<div class="commentBody">
				<?= $comment->content?>
				</div>
			</div>
		<?php }?>
		<!-- 导航部分-->
		@include('nav', array('currentPage' => Request::get('page'), 'itemCount' => count($comments), 
				'pageUrl' => '../userComments?page='))
	</div>
@stop