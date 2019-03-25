<?php
    include_once "includes/functions.php";
    include_once "includes/repository.php";
    include_once "includes/session.php";

    $myTitle = "Joke Details";

    confirm_logged_in_as_admin();
?>
<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1><?= $myTitle ?></h1>

    <?php

        if (empty($_GET["id"]) || !is_numeric($_GET["id"])) {
            echo <<<EOT
            <h3 class="message">Invalid Data</h3><br>
            <a href="approve_jokes.php">Go back and try again</a>
EOT;
        }else{
            $id = $_GET['id'];
            $jokeId = intval($id);

            include_once 'includes/open_connection.php';
            $link = make_connection('joker');
            $result = $link->query("CALL getJokeDetails(".$jokeId.")");

            if ($row = $result->fetch_assoc()){
                echo "<div class='background'><b>Title: </b>".$row['title']."<br>";
                echo "<b>Joke ID: </b>".$row['id']."<br><br>";
                echo "<b>Teaser: </b>".$row['teaser']."<br><br>";
                echo "<b>Joke Text: </b>".$row['joke_text']."<br><br>";
                echo "<b>Delete:</b>"."<a href='delete_joke.php?id=".$row['id']."'>Delete this joke</a><br></div><hr>";
            }else{
                echo "<h3 class='message'>Invalid Data.</h3>";
                echo "<a href='approve_jokes.php'>Go back and try again.</a>";
            }
        }
    ?>

    <?php include_once 'includes/footer.php'; ?>
</body>
</html>