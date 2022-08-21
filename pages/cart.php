<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("Cart"); ?>

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

endforeach;

Template::footer();

?>