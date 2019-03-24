<?php
    $myTitle = "New User";
?>
<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1><?= $myTitle ?></h1>

    <?php
        include_once "includes/functions.php";
        include_once 'includes/repository.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["submit"])){
            if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['uname']) || empty($_POST['pwd']) || empty($_POST['utype']) || empty($_POST['email'])) {
                echo "<h3 class='message'>Please fill out all fields<br><a href='new_user.php'>Go back and try again</a></h3>";
            }else{
                $uploaded_file = upload_image("file");
                if(!empty($uploaded_file)){
                    Repository::Instance()->add_new_user($_POST['fname'],$_POST['lname'],$_POST['uname'],$_POST['pwd'],$_POST['utype'],$_POST['email'],$uploaded_file,function($id){
                        echo "<h3 class='message'>Saved \"".$_POST['uname']."\" in the database.Yay!<br>New User ID is ".$id."</h3>";
                    });
                }
            }
        }else{
    ?>
            <form action="new_user.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Create User</legend><br><br>

                    <label for="fname">First Name</label><br>
                    <input type="text" name="fname"><br><br>

                    <label for="lname">Last Name</label><br>
                    <input type="text" name="lname"><br><br>

                    <label for="uname">Username</label><br>
                    <input type="text" name="uname"><br><br>

                    <label for="pwd">Password</label><br>
                    <input type="password" name="pwd"><br><br>

                    <label for="utype">User Type</label><br>
                    <select name="utype" id="utype">
                        <option value="">-- Select a user type --</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select><br><br>

                    <label for="email">Email</label><br>
                    <input type="text" name="email"><br><br>

                    <label for="file">Upload Avatar:</label>
                    <input type="file" name="file" id="file">

                    <input type="submit" name="submit" value="Save" class="btn">
                    <button class="btn">Cancel</button>
                    <br><br>

                    <a href="logout.php">Log out</a>
                </fieldset>
            </form>
    <?php
        }
    ?>

    <?php include 'includes/footer.php'; ?>
</body>
</html>