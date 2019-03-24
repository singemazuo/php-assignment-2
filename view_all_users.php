<?php
    include_once "includes/functions.php";
    include_once "includes/repository.php";
    include_once "includes/session.php";

    $myTitle = "All Users";

    confirm_logged_in_as_admin();
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1><?= $myTitle ?></h1>

    <?php

        Repository::Instance()->retrieve_all_users(function($user){
            echo "<div class='background'>";
            echo "<b>Username:</b> ".$user["username"]."<br>";
            echo "<b>Name:</b> ".$user["first_name"]." ".$user["last_name"]."<br>";
            echo "<a href='view_user_details.php?uid=".$user["id"]."'>View User Details</a>";
            echo "</div><hr>";
        });
    ?>

    <?php include 'includes/footer.php'; ?>
</body>
</html>