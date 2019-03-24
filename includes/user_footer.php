<div id="userfooter">
    <br>

    <?php
    if (isset($_SESSION["username"])){
    ?>
        <a href="show_all_jokes.php">Show All Jokes</a> |
        <a href="add_joke.php">Add Jokes</a> |
    <?php
        echo "<a href='login.php?message=1'>Logout</a> |";
        echo "Logged in as".$_SESSION["username"];
    }else{
    ?>
        <a href="show_all_jokes.php">Show All Jokes</a> |
    <?php
        echo "<a href='login.php?message=1'>Login</a>";
    }
    ?>
</div>