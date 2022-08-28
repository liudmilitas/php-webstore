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
        <img src="<?= $product->img_url ?>" alt="<?= $product->title ?>" width="50" height="50">
        <p><?= $product->title ?> <strong><?= $product->price ?> kr</strong></p>
    </div>

<?php

endforeach;?>

<br>
            <input class="order-button" type="submit" value="Place order">
  </form>
<?php
Template::footer();

?>
