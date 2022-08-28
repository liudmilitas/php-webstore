<?php

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/OrderProducts.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/Product.php";

session_start();

$success = false;

if (isset($_SESSION["user"]) && isset($_SESSION["cart"])) {
    $cart = $_SESSION["cart"];
    $user = $_SESSION["user"];

    $orders_db = new OrdersDatabase();

    $current_date = date("Y-m-d");

    $status = "Pending";

    $order = new Order($user->id, $status, $current_date);

    $products = array();
    foreach ($cart as $value) {
        array_push($products, new OrderProducts(0, $value->id));
    }

    $success = $orders_db->create($order, $products);

} else {
    die("You need to be logged in to place an order");
}

if ($success) {
    $_SESSION["cart"] = null;
    header("location: /php-webstore/pages/order.php");
} else {
    die("Error placing order");
}