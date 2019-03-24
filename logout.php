<?php $myTitle = "Logout"; ?>

<!doctype html>
<html lang="en">
<?php include_once 'includes/header.php'; ?>
<body>
    <?php
        include_once 'includes/session.php';
        include_once 'includes/functions.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_SESSION['username'] = "";
            $_SESSION['id'] = "";

            echo "<h3 class='message'></h3>";
            redirect_to('index.php');
        }else{
            if (!empty($_SESSION['username']) && !empty($_SESSION['id'])){
                // has logged in
                echo <<<ETO
                    <form action="logoutB.php" method="post">
                        <input type="submit" name="logout" value="logout">
                    </form>
ETO;

            }
        }
    ?>

    <? include 'includes/footer.php'; ?>
</body>
</html>