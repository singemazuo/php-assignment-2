<?php
    $myTitle = "View User Details";
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1><?= $myTitle ?></h1>

    <?php
        include_once "includes/functions.php";
        include_once 'includes/repository.php';

        if (!empty($_GET['uid'])){
            $uid = $_GET['uid'];
            Repository::Instance()->retrieve_user_details($uid,function($user_details){
                echo "<div class='background'>";
                echo "<b>First Name:</b> ".$user_details["first_name"]."<br>";
                echo "<b>Last Name:</b> ".$user_details["last_name"]."<br>";
                echo "<b>Email:</b> ".$user_details["email"]."<br><br>";
                echo "<b>User Type:</b> ".$user_details["user_type"]."<br>";
                echo "<img src='".$user_details["avatar"]."'>";
                echo "</div><hr>";
            });
        }else{

        }
    ?>

    <?php include 'includes/footer.php'; ?>
</body>
</html>