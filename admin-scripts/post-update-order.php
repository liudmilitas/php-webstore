<?php

require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/force-admin.php";


$orders_db = new OrdersDatabase();
$success = false;

if (isset($_POST["status"]) && isset($_POST["id"])) {
    $user_role = $_POST["role"];
    $user_id = $_GET["id"];
    $success = $orders_db->update_order("done", $_POST["id"]);
} else {
    die("Error updating order");
}

if ($success) {
    header('Location: /php-webstore/pages/admin.php');
}
?>