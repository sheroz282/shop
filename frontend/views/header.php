<?php
    include_once __DIR__ . "/../../common/src/Service/UserService.php";
    include_once __DIR__ . "/../../common/src/Service/CategoryService.php";
    include_once __DIR__ . "/../../common/src/Service/BasketDBService.php";
    include_once __DIR__ . "/../../common/src/Service/ProductService.php";

	$currentUser = UserService::getCurrentUser();
    $basketDetails = (new ProductService())->getBasketItems(BasketDBService::defineBasketDetails());

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale=1>
    <title>Shop</title>
    <link rel="stylesheet" href="http://alif/frontend/css/styles.css">
    <link rel="stylesheet" href="http://alif/frontend/css/shop-style.css">
    <script
        src="http://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous">
    </script>
    <script src="http://alif/frontend/js/scripts.js"></script>
</head>
<body>
    <header>
        <div id="head">
            <div class="top">
                <div class="width1024">
                    <ul class="desktop-element">
                        <li><?=!empty($currentUser ['login']) 
                            ? '<span style="color: #fff">Hello, ' . $currentUser ['login'] . '!</span>' 
                            : '<a href="/frontend/index.php?model=register&action=form">Register</a>'?></li>
                        <li><?=!empty($currentUser ['login']) 
                            ? '<a href="/frontend/index.php?model=auth&action=logout">Sing out</a>'
                            : '<a href="/frontend/index.php?model=site&action=login">Sing in</a>'?></li>
                        <?=!empty($currentUser ['login']) ? '<li><a href="/frontend/index.php?model=basket&action=view">Basket</a></li>' : '' ?>
                        <li><a href="">Help</a></li>
                    </ul>
                    <div id="mobile-logo" class="mobile-element">BOOKS</div>
                    <select id="top-link" onchange="document.location=this.value" class="mobile-element form-control">
                        <option disable selected></option>
                        <option value="/frontend/index.php?model=register&action=form">Register</option>
                        <option value="/frontend/index.php?model=site&action=login">Sing in</option>
                        <option value="#order">Order Status</option>
                        <option value="#help">Help</option>
                    </select>
                </div>            
            </div>
            <div class="header-panel">
                <div class="width1024 flex">
                    <div id="logo">
                        <a href="//alif/frontend/index.php"><img src="/frontend/img/logo.png"></a>
                    </div>
                    <div id="search-field">
                        <form action="#">
                            <input type="text" name="search_text">
                            <button>Search</button>
                        </form>
                    </div>
                    <div id="basket-container">
                        <div>Your cart<span>(<?=sizeof($basketDetails['items'] ?? [])?>items)</span></div>
                        <div><b>$<?=$basketDetails['total'] ?? 0 ?></b><a href="#">Checkout</a></div>
                    </div>
                    <div id="favor">
                        <div>Wish list</div>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <ul class="width1024 desktop-element">
                <?php foreach (CategoryService::getGenre() as $genre) : ?>
                    <li><a href="/frontend/index.php/?model=product&action=all&category_id=<?=$genre['id']?>"><?=$genre['title']?></a></li>
                <?php endforeach; ?>
            </ul>
            <select onchange="document.location=this.value" class="mobile-element">
                <option disabled selected></option>
                <option value="#computers">Computers</option>
                <option value="#cooking">Cooking</option>
                <option value="#education">Education</option>
                <option value="#fiction">Fiction</option>
                <option value="#health">Health</option>
                <option value="#matematics">Matematics</option>
                <option value="#medical">Medical</option>
                <option value="#reference">Reference</option>
                <option value="#science">Science</option>
            </select>
        </nav>
    </header>

<div class="body">