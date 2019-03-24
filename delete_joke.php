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

    }else{
        $jid = intval($_GET['id']);
        $stmt = $link->prepare("CALL deleteJoke(?)");
        $stmt->bind_param("d",$jid);
        if($result = $stmt->execute()){
            echo "<h3 class='message'>Deleted joke id ".$jid."<br><a href='show_jokes_delete.php'>Take me to delete more jokes! The world does not need laughter!</a></h3>";
        }else{

        }
    }

    if ($result = $link->query('CALL deleteJoke()')){
        while ($row = $result->fetch_assoc()){
            echo "<div class='background'><b>Title: </b>".$row['title']."<br>";
            echo "<b>Teaser: </b><a href='joke_details.php?id='".$row['id']."'>".$row['teaser']."</a><br>";
            echo "<b>Joke Text: </b>".$row['joke_text']."<br><br>";
            echo "<a href='joke_approval.php?id=".$row['id']."'>Approve Joke</a></div><hr>";
        }
    }
    
    $link->close();
    include 'includes/footer.php';?>
</body>
</html>