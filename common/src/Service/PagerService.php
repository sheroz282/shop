<?php
include_once __DIR__ . "/../Model/Product.php";

class PagerService{
	
	public static function printPager()
	{
		$allPageNumber = (new Product())->getNumberPage($_GET['category_id'] ?? [], 
				$_GET['limit'] ?? Product::NUMBER_PRODUCTS_PER_PAGE);
		$currentPage = intval($_GET['page'] ?? 1);
		$arNumbersPages = [];
		$firstNumberPage = 1;
		if($currentPage >= 2){
			if($currentPage > $allPageNumber - 2){
				$arNumbersPages[] = $currentPage-4;
			}
			if($currentPage > $allPageNumber - 1){
				$arNumbersPages[] = $currentPage-3;								
			}
			if($currentPage >= 3){
				$arNumbersPages[] = $currentPage-2;								
			}
			$arNumbersPages[] = $currentPage-1;
		}
		$arNumbersPages[] = $currentPage;
		for($next=1; sizeof($arNumbersPages) < 5; $next++){
			$arNumbersPages[] = $currentPage + $next;
		}
	?>
             <div class="pager">
                 <?php print '<div class="link-to-end"><a href="/frontend/index.php/?model=product&action=all&' . (isset($_GET['category_id'])? 'category_id='.$_GET['category_id']. '&' : '') . 'page=1"><<</a></div>'; ?>
                 <?php print '<div class="link-to-left"><a href="/frontend/index.php/?model=product&action=all&' . (isset($_GET['category_id'])? 'category_id='.$_GET['category_id']. '&' : '')
			. 'page= ' . ($currentPage - 1) . '"><</a></div>'; ?>
		<?php foreach($arNumbersPages as $numbersPage){
				print '<div class="link-pager'. (intval($_GET['page'] ?? 0) === $numbersPage ? ' current':'') . '"><a href="/frontend/index.php/?model=product&action=all&' . (isset($_GET['category_id'])? 'category_id='.$_GET['category_id']. '&' : '') . 'page=' . $numbersPage . '">' . $numbersPage . '</a></div>';
			}
		?>
                 <?php print '<div class="link-to-right"><a href="/frontend/index.php/?model=product&action=all&' . (isset($_GET['category_id'])? 'category_id='.$_GET['category_id']. '&' : '')
			. 'page= ' . ($currentPage + 1) . '">></a></div>'; ?>
		 <?php print '<div class="link-to-end"><a href="/frontend/index.php/?model=product&action=all&' . (isset($_GET['category_id'])? 'category_id='.$_GET['category_id']. '&' : '') . 'page=' . $allPageNumber . '">>></a></div>'; ?>
             </div>	
		<?php
	}
}
