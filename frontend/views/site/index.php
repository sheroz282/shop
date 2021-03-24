<?php
    include_once __DIR__ . "/../header.php";
	include_once __DIR__ ."/../../../common/src/Service/PagerService.php";
?>
<div id="banner-container" class="width1024">
    <div id="slider">
        <div class="slides">
            <div class="slide"><a href="#"><img src="img/banner01.jpg"></a></div>
            <div class="slide"><a href="#"><img src="img/banner02.jpg"></a></div>
        </div>
        <a href="#" class="banner-btn btn-left"><span></span><img src="img/banner_arrow_left.png"></a>
        <a href="#" class="banner-btn btn-right"><span></span><img src="img/banner_arrow_right.png"></a>
    </div>
    <div id="rand-product-banner">
        <h3>Deal of the Month</h3>
        <div class="slugan">The Human Face of Big Date</div>
        <div class="pic"><a href="#"><img src="img/book01.jpg"></a></div>
        <div class="price">
            <span>Save 45% Today</span>
            <b>$123.0</b>
        </div>
        <div class="btn-buy">
            <a href="#">Buy now</a>
        </div>
    </div>
</div>
<div id="content" class="width1024">
        
<?php
    include_once __DIR__ . "/../sidebar.php";
?>

    <div class="body">
        <div class="bookmarks desktop-element">
            <ul>
                <li class="active"><a href="#">Best sellers</a></li>
                <li><a href="#">New Arrivals</a></li>
                <li><a href="#">Used Books</a></li>
                <li><a href="#">Special offers</a></li>
            </ul>
        </div>
        <div class="bookmarks-mobile mobile-element">
            <select onchange="document.location=this.value">
                <option value="#sellers">Best sellers</option>
                <option value="#Arrivals">New Arrivals</option>
                <option value="#">Used Books</option>
                <option value="#">Special offers</option>
            </select>
        </div>
        <div id="products-list">
            <ul>
                <?php for ($i = 0; $i < count($all); $i++) : 
                    if ($i % 5 === 0) print "</ul><ul>";
                ?>
                    <li>
                        <img src="img/sole30.png">
                        <a href="http://alif/frontend/index.php?model=product&action=view&id=<?=$all[ $i ] ['id']?>"><img src="http://alif/uploads/products/<?=$all[ $i ] ['picture']?>"></a>
                        <h4><a href="http://alif/frontend/index.php?model=product&action=view&id=<?=$all[ $i ] ['id']?>"><?=$all[ $i ] ['title']?></a></h4>
                        <div class="price"><?=$all[ $i ] ['price']?></div>
                    </li>
                <?php endfor; ?>
            </ul>
            <?php
				PagerService::printPager();
			?>
        </div>

    </div>
</div>
<?php
    include_once __DIR__ . "/../footer.php";
?>