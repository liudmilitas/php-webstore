<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";


$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401); // ACCESS DENIED
    die("Access denied");
}

$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();
$orders_db = new OrdersDatabase();

$users = $users_db->get_all();
$products = $products_db->get_all();
$orders = $orders_db->get_all_orders();


Template::header("Admin area"); ?>

<h2>Create product</h2>

<form action="/php-webstore/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required> <br>
    <textarea name="description" placeholder="Description" required></textarea> <br>
    <input type="number" name="price" placeholder="Price" required> <br>
    <input type="file" name="image" accept="image/*" required> <br>
    <input type="submit" value="Save">
</form>

<hr>

<h2>Products</h2>

<?php foreach ($products as $product) : ?>
    <p>
        <a href="/php-webstore/pages/admin-product.php?id=<?= $product->id ?>">
            <?= $product->title ?>
        </a>
    </p>
<?php endforeach; ?>

<hr>

<h2>Users</h2>

<?php foreach ($users as $user) : ?>
    
    <p>
        <a href="/php-webstore/pages/admin-user.php?id=<?= $user->id ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>
    </p>

<?php endforeach; ?>

<hr>

<h2>Orders</h2>

<?php foreach ($orders as $order) : ?>
    <div>
        <p>
            <a href="admin-order.php?id=<?= $order->id ?>">Order №<?= $order->id ?></a> [<?= $order->status ?>]
        </p>
    </div>

<?php endforeach;

Template::footer();

?>