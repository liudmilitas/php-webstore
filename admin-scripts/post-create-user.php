<?php

require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

if(
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST["confirm-password"]) &&
    isset($_POST['role']) &&
    
    strlen($_POST['username']) > 0 &&
    strlen($_POST['password']) > 0 

) {
    $user_db = new UsersDatabase();
    $user = new User($_POST['username'],  $_POST['role']);
    $user->hash_password($_POST['password']);
    $success = $users_db->create($user);
} else {
    die('Invalid input');
}

if ($success) {
    header("Location: /php-webstore/pages/admin.php");
} else {
    echo "Error creating user";
}