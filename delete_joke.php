<?php
    include 'includes/session.php';
    include 'includes/functions.php';

    $myTitle = 'Joke Delete';

    // confirm_logged_in_as_admin();
?>

<!doctype html>
<html lang="en">

<?php include 'includes/header.php';?>
<body>
    <h1><?php echo $myTitle; ?></h1>
    <?php
    include_once 'includes/open_connection.php';

    $link = make_connection('joker');

    if (empty($_GET['id']) || !is_numeric($_GET['id'])){
        echo <<<EOT
            <h3 class="message">Invalid Data</h3><br>
            <a href="approve_jokes.php">Go back and try again</a>
EOT;
    }else{
        $jid = intval($_GET['id']);
        $stmt = $link->prepare("CALL deleteJoke(?)");
        $stmt->bind_param("d",$jid);
        if($result = $stmt->execute()){
            if ($link->affected_rows > 0){
                echo "<h3 class='message'>Deleted joke id ".$jid."<br><a href='show_jokes_delete.php'>Take me to delete more jokes! The world does not need laughter!</a></h3>";
            }else{
                echo <<<EOT
                    <h3 class="message">Invalid Joke Id</h3><br>
EOT;
            }
        }else{
            echo <<<EOT
            <h3 class="message">Invalid Joke Id</h3><br>
EOT;
        }
    }
    
    $link->close();
    include 'includes/footer.php';?>
</body>
</html>