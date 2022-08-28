<?php

// Ladda in klasser
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

session_start();

if (isset($_POST["product-id"])) {

    // Hämta produkten som klickats på
    $products_db = new ProductsDatabase();
    $product = $products_db->get_one($_POST["product-id"]);

    // Skapa varukorg om den inte finns
    if (!isset($_SESSION["cart"])) {
        $_SESSION['cart'] = array();
    }

    // Lägg produkt i varukorg
    if ($product) {
        array_push($_SESSION["cart"], $product);

        // Redirecta till produkt-sidan
        header("Location: /php-webstore/pages/products.php");
    }
} else {
    die("Invalid input");
}
?>