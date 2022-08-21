<?php

require_once __DIR__ . "/../classes/Template.php";

Template::header("Login");

if (isset($_GET["error"]) && $_GET["error"] == "wrong_pass") : ?>

<h2>Wrong username or pass!</h2>

<?php endif; ?>

<form action="/php-webstore/scripts/post-login.php" method="post">
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="submit" value="Login">
</form>

<?php

Template::footer();
?>