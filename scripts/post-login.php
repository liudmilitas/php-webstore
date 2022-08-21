<?php

require_once __DIR__ . "../classes/UsersDatabase.php";

if(isset($_POST["username"]) && isset($_POST["password"]) ){
    
    $users_db = new UsersDatabase();

    $user = $users_db->get_one_by_username($_POST["username"]);

    if($user && $user->test_password($_POST["password"])){ // CORRECT USERNAME & PASSWORD
        session_start();

        $_SESSION["user"] = $user;

        header("Location: /php-webstore");
    }
    else{
        header("Location: /php-webstore/pages/login.php?error=wrong_pass");
        die();
    }
    
}
else{
    die("Invalid input");
}
?>