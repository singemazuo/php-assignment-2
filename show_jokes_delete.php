<?php
    $myTitle = "Delete Jokes";
?>

<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
    <h1><?= $myTitle ?></h1>

    <?php

    include "includes/open_connection.php";

    $link = make_connection("joker");

    $sql = "CALL getJokes()";
    $result = $link->query($sql);
    while (list($id,$title,$teaser,$joke_text,$visible,$date) = $result->fetch_row()){
        echo <<<ETO
                <div class="background">
                <p><b>Title:</b> $title
                <br><b>Teaser:</b> <a href="joke_details.php?id=$id">$teaser</a>
                <br><b>Joke Text:</b> $joke_text<br><br>
                <a href='delete_joke.php?id=$id'>Delete Joke</a>
                </div><hr>
ETO;
    }

    echo "The total number of jokes: $result->num_rows";

    $result->close();
    $link->close();
    ?>

    <?php include "includes/footer.php"; ?>
</body>
</html>