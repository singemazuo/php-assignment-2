<?php
    include 'includes/session.php';
    include 'includes/functions.php';

    $myTitle = 'Approve Jokes';

    // confirm_logged_in_as_admin();
?>

<!doctype html>
<html lang="en">

<?php include 'includes/header.php';?>
<body>
    <h1><?php echo $myTitle; ?></h1>
    <?php
    include 'includes/open_connection.php';

    $link = make_connection('joker');

    if ($result = $link->query('CALL getJokesForApproval()')){
        while ($row = $result->fetch_assoc()){
            echo "<div class='background'><b>Title: </b>".$row['title']."<br>";
            echo "<b>Teaser: </b><a href='joke_details.php?id=".$row['id']."'>".$row['teaser']."</a><br>";
            echo "<b>Joke Text: </b>".$row['joke_text']."<br><br>";
            echo "<a href='joke_approval.php?id=".$row['id']."'>Approve Joke</a></div><hr>";
        }
    }
    
    $link->close();
    include 'includes/footer.php';
    ?>
</body>
</html>