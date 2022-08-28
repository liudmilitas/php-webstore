<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("Cart"); ?>

<form class="products-cart-form" action="/php-webstore/scripts/post-place-order.php" method="post">
<div id="product-details" hidden>
    <img src="" id="product-img" height="50" width="50">
    <p id="product-title"></p>
    <p id="product-description"></p>
    <p id="product-price"></p>
</div>

<?php foreach ($products as $product) : ?>

    <div>
        <b><?= $product->title ?></b>
        <button data-id="<?= $product->id ?>" class="show-product-details">Show</button>
    </div>

<?php

endforeach;?>

<br>
            <input class="cart-button" type="submit" value="Place order">
        </form>
        <?php
Template::footer();

?>
