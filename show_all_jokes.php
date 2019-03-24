<?php
    $myTitle = "All Jokes";
?>

<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1><?= $myTitle ?></h1>

    <?php

    include "includes/open_connection.php";

    $link = make_connection("joker");

    $sql = "SELECT * FROM jokes";
    $result = $link->query($sql);
    if ($result = $link->query('CALL getJokes()')){
        while (list($id,$title,$teaser,$joke_text,$visible,$date) = $result->fetch_row()){
            echo <<<ETO
                <div class="background">
                <p><b>Title:</b> $title
                <br><b>Teaser:</b> $teaser
                <br><b>Joke Text:</b> $joke_text<br>
ETO;

            $date = date_create($date);
            echo "<b>Date:</b> ".$date->format('D M j, Y')."<br>";
            echo "<b>Time:</b> ".$date->format('h:i a');
            echo "</div><hr>";
        }

        echo "The total number of jokes: $result->num_rows";
    }

    $result->close();
    $link->close();
    ?>

    <?php include "includes/footer.php"; ?>
</body>
</html>