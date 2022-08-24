<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

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

$username = $_GET["username"];
$users_db = new UsersDatabase();
$user = $users_db->get_one_by_username($username);


Template::header("Update user");

if ($user == null) : ?>

    <h2>No user found</h2>

<?php else : ?>

    <div>
        <p>Id: <?= $user->id ?></p>
        <p>Username: <?= $user->username ?></p>
        <p>Role: <?= $user->role ?></p>
    </div>

    <form action="/php-webstore/admin-scripts/post-update-user.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="role" placeholder="Role" value="<?= $user->role ?>"> <br>
        <input type="submit" value="Save">
    </form>

    <p><b>Delete:</b></p>

    <form action="/php-webstore/admin-scripts/post-delete-user.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <input type="submit" value="Delete user">
    </form>


<?php

endif;

Template::footer();

?>