<?php

require_once __DIR__ . "/../classes/ProductsDatabase.php";

require_once __DIR__ . "/force-admin.php";

$success = false;


if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"])){

    $upload_directory = __DIR__ . "/../assets/uploads/"; // C:/wamp64/www/php-webstore/admin-scripts/../assets/uploads/

    $upload_name= basename($_FILES["image"]["name"]); // katt.jpeg

    $name_parts = explode(".", $upload_name); // ["katt", "jpeg"]

    $file_extension = end($name_parts); // "jpeg"

    $timestamp = time(); // "16237892"

    $file_name = "{$timestamp}.{$file_extension}"; // "16237892.jpeg"

    $full_upload_path = $upload_directory . $file_name; // "C:/wamp64/www/shop/php-webstore/../assets/uploads/16237892.jpeg"

    $full_relative_url = "/php-webstore/assets/uploads/{$file_name}";

    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if($success){
        $product = new Product($_POST["title"], $_POST["description"], $_POST["price"], $full_relative_url);

        $products_db = new ProductsDatabase();

        $success = $products_db->create($product);
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