<?php
include 'includes/session.php';
include 'includes/functions.php';

$myTitle = 'Approve Jokes';

confirm_logged_in_as_admin();
?>

<!doctype html>
<html lang="en">

<?php include 'includes/header.php';?>
<body>
<h1><?php echo $myTitle; ?></h1>
<?php
//    $id = $_GET['id'];
//    $jokeId = intval($id);

    if (empty($_GET['id']) || !is_numeric($_GET['id'])){
        echo <<<EOT
            <h3 class="message">Invalid Data</h3><br>
            <a href="approve_jokes.php">Go back and try again</a>
EOT;
    }else{
        $id = $_GET['id'];
        $jokeId = intval($id);

        include 'includes/open_connection.php';
        $link = make_connection('joker');

        if ($result = $link->query("CALL approveJoke($jokeId)")){
            echo <<<EOT
                <h3 class="message">Joke id $jokeId has been approved!</h3><br>
                <div style='text-align:center'><a href="approve_jokes.php">Approve more jokes</a></div>
EOT;
        }else{
            echo "<h3>Update failed</h3>";
        }
    }
?>

<?php include 'includes/footer.php'; ?>
</body>
</html>
