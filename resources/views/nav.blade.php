<!-- 需要传入currentPage、pageUrl，如comment?page= 
	 以及itemCount即当前页的item数量-->
		<?php 
		/* 这里并不能获取到Request
			if (!isset($currentPage)) {
				$currentPage = Request::get('$page');
			}-->*/
			$minPage;
			$maxPage;
			$hasPage;
			if ($currentPage == 0 && $leftPage == 0 && $itemCount == 0) {
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
			  <a href=<?= $pageUrl.($currentPage - 1)?> aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			  </a>
			</li>
		  <?php }?>
			<?php
				for ($page = $minPage; $page <= $maxPage; ++$page) {
			?>
				<li <?= $page==$currentPage? "class='active'":""?>><a href=<?= $pageUrl.$page?>>
				<?= $page + 1?></a></li>
			<?php }?>
			
			<?php if($leftPage != 0) {?>
			<li>
			  <a href=<?= $pageUrl.($currentPage + 1)?>  aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			  </a>
			</li>
			<?php }?>
		  </ul>
		</nav>