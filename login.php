<?php $myTitle = "Login"; ?>

<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1>Login</h1>
    <?php

    include_once 'includes/session.php';
    include_once 'includes/functions.php';
    include_once 'includes/repository.php';

    function createLoginForm(){
        echo <<<ETO
            <div id="login">
                <form action="login.php" method="post">
                    <table style="margin: auto auto;">
                        <tr>
                            <td style="text-align: left"><label for="username" class="loglabel">Username:</label></td>
                            <td><input type="text" name="username" style="width: 100%;"/></td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><label for="password">Password:</label></td>
                            <td><input type="password" name="password" style="width: 100%;"/></td>
                        </tr>
                        <tr><td colspan="2" style="text-align: left"><input type="submit" value="Login" class="btn"></td></tr>
                    </table>
                </form>
            </div>
ETO;

    }

    ?>

    <div style="text-align:center">

    <?php

    if(isset($_GET['message'])) {
        $messagecode = trim($_GET['message']);
        $message = "";
        if ($messagecode == 1) {
            unset($_SESSION['username']);
            unset($_SESSION['user_type']);

            $message = "You have successfully logged out!";
        } elseif ($messagecode == 2) {
            $message = "Please login...";
        }elseif($messagecode == 3){
            $message = "Please login as Admin to view this page...";
        }
        echo "<h3 class='message'>" . $message . "</h3>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        Repository::Instance()->login($username,$password,function($id,$fname,$lname,$user_type) {
            GLOBAL $username;
            if ($id != null) {
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;

                echo "<h3 class='message'>You are now logged in as " . $_SESSION['username'] . "</h3><br>";
            } else {
                echo "<h3>Invalid username or password</h3>";
                echo "<a href='login.php'>Go back and try again</a>";
            }
        });
    }else{
        // if (!empty($_SESSION['username']) && !empty($_SESSION['id'])){
        //     if (isset($_GET['author_id']) && isset($_GET['post_id'])){
        //         // the user wants to modify a existed post
        //         if ($_SESSION['id'] != $_GET['author_id']){
        //             // the author is not that logged in user return a caution message to remind user he/she doesn't have privilege to modify
        //             echo "<h3 class='message'>You are not the author of this post.</h3><br>";
        //             echo "<p>You can either <a href='logoutB.php'>Logout</p> or ";
        //             echo "<a href='display_authors_same_page.php'>Go back to post page</a>";
        //         }else{
        //             // otherwise the user is author, he/she can modify this post
        //             $post_id = $_GET['post_id'];
        //             echo "<p>You can either <a href='logoutB.php'>Logout</p> or ";
        //             echo "<a href='save_entry_db.php?post_id=$post_id'>Update the selected post</a>";
        //         }
        //     }else{
        //         echo "<h3 class='message'>You has logged in as " . $_SESSION['username'] . "</h3><br>";
        //         echo "<p>You can either <a href='logoutB.php'>Logout</p> or ";
        //         echo "<a href='save_entry.php?author_id=".$_SESSION['id']."'>Create a new post</a>";
        //     }
        // }else{
        //     createLoginForm();
        // }
        createLoginForm();
    }
    ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>