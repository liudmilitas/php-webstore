<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Access denied");
}

if (!isset($_GET["id"])) {
    die("Invalid input");
}

$products_db = new ProductsDatabase();

$product = $products_db->get_one($_GET["id"]);

Template::header("Update product");

if ($product == null) : ?>

    <h2>No product found</h2>

<?php else : ?>

    <form action="/php-webstore/admin-scripts/post-update-product.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" value="<?= $product->title ?>" required> <br>
        <textarea name="description" placeholder="Description"><?= $product->description ?></textarea> <br>
        <input type="number" name="price" placeholder="Price" value="<?= $product->price ?>"> <br>
        <input type="file" name="image" accept="image/*" required> <br>
        <input type="submit" value="Save">
    </form>

    <p><b>Delete:</b></p>

    <form action="/php-webstore/admin-scripts/post-delete-product.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <input type="submit" value="Delete product">
    </form>


<?php

endif;

Template::footer();