<?php

require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;
$products_db = new ProductsDatabase();


if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_GET["id"])){

    $upload_directory = __DIR__ . "/../assets/uploads/"; // C:/wamp64/www/shop/admin-scripts/../assets/uploads/

    $upload_name= basename($_FILES["image"]["name"]); // katt.jpeg

    $name_parts = explode(".", $upload_name); // ["katt", "jpeg"]

    $file_extension = end($name_parts); // "jpeg"

    $timestamp = time(); // "16237892"

    $file_name = "{$timestamp}.{$file_extension}"; // "16237892.jpeg"

    $full_upload_path = $upload_directory . $file_name; // "C:/wamp64/www/shop/admin-scripts/../assets/uploads/16237892.jpeg"

    $full_relative_url = "/php-webstore/assets/uploads/{$file_name}";

    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if($success){
        $products_db = new ProductsDatabase();
        $product = new Product($_POST["title"], $_POST["description"], $_POST["price"], $full_relative_url);
        $success = $products_db->update($product, $_GET["id"]);
    }
}
else{
    die("Invalid input");
}


if($success){
    header("Location: /php-webstore/pages/admin.php");
    die();
}
else{
    die("Error saving product");
}