<?php

require_once __DIR__ . "/../classes/Template.php";

require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Access denied");
}

$orders_db = new OrdersDatabase();

$order = $orders_db->get_order_by_id($_GET["id"]);
$products = $orders_db->get_all_order_products($_GET["id"]);

Template::header("Order №{$_GET["id"]}", "");

?>



<div>
    <p>Order id: <?= $order->id ?></p>
    <p>Customer id: <?= $order->user_id ?></p>
    <p>Status: <?= $order->status ?></p>
    <p>Order date: <?= $order->order_date ?></p>
    <div>Order Products:
    <?php foreach ($products as $product) : ?>
        <div>
            <p>
                <?= $product["title"] ?>
            </p>
            <img src="<?= $product["img-url"] ?>" alt="<?= $product["title"] ?>" width="50" height="50">
        </div>
    <?php endforeach; ?>
    </div>
</div>

<div>
    <?php if ($order->status == "done") : ?>
        <p>Status: <?= $order->status ?></p>
    <?php else : ?>
        <form action="/php-webstore/admin-scripts/post-update-order.php" method="POST">
            <label>Mark as Done</label> <br>
            <input type="hidden" name="id" value="<?= $order->id ?>">
            <input type="hidden" name="status" value="done">
            <input type="submit" value="Done">
        </form>
    <?php endif ?>
</div>






<?php
Template::footer();
?>