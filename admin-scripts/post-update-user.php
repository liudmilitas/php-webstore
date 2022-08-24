<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/force-admin.php";

$users_db = new UsersDatabase();

$success = false;

if (isset($_POST["role"]) && isset($_POST["id"])) {
    $user_role = $_POST["role"];
    $user_id = $_POST["id"];
    $success = $users_db->update($user_role, $user_id);
} else {
    echo "Invalid input";
}
if ($success) {
    header("Location: /php-webstore/pages/admin.php");
} else {
    echo "Error updating user";
}