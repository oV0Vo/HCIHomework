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
		
		<!-- 导航部分-->
		<?php 
			$currentPage = Request::get('page');
			$minPage;
			$maxPage;
			$hasPage;
			if ($currentPage == 0 && $leftPage == 0) {
				$hasPage = false;
			} else {
				$hasPage = true;
				$maxPage = $currentPage + $leftPage;
				if ($currentPage < 5) {
					$minPage = 0;
				} else {
					$minPage = $currentPage - 5;
				}
			}?>
		<nav>
		  <ul class="pagination">
		  <?php if($currentPage != 0) {?>
			<li>
			  <a href=<?= '../userComment?page='.($currentPage - 1)?> aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			  </a>
			</li>
		  <?php }?>
			<?php 
				for ($page = $minPage; $page <= $maxPage; ++$page) {
			?>
			<li <?= $page==$currentPage? "class='active'":""?>><a href=<?= '../userComment?page='.$page?>>
			<?= $page + 1?></a></li>
			<?php }?>
			
			<?php if($leftPage != 0) {?>
			<li>
			  <a href=<?= '../userComment?page='.($currentPage + 1)?>  aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			  </a>
			</li>
			<?php }?>
		  </ul>
		</nav>
	</div>
@stop