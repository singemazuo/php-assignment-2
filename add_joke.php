<?php $myTitle = 'New Joke'; ?>
<?php include 'includes/repository.php'; ?>

<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body>
<h1><?= $myTitle ?></h1>
<div class="background">
    <?php
        if (!empty($_POST['submit'])){
            $title = $_POST['title'];
            $teaser = $_POST['teaser'];
            $text = $_POST['text'];
            $author = $_POST['author'];
            $category = $_POST['category'];

            Repository::Instance()->insert_joke($title,$teaser,$text,$author,$category,function ($insert_id,$result){
                if ($result != 0){
                    echo "<h3 class='message'>Record ".$insert_id." has been inserted successfully</h>";
                }else{
                    echo "<h3 class='message'>Oops! Errors. </h3>";
                }
            });
        }else{
    ?>
        <form action="add_joke.php" method="post">
            <label for="title">Joke Title:</label><br>
            <input type="text" name="title"><br>

            <br>

            <label for="teaser">Joke Teaser:</label><br>
            <input type="text" name="teaser"><br>

            <br>

            <label for="text">Joke Text:</label><br>
            <textarea name="text" cols="30" rows="10"></textarea>

            <br>

            <label for="author">Joke Author:</label><br>
            <select name="author">
                <option value="0">-- select an author --</option>
                <?php

                Repository::Instance()->retrieve_all_users(function($row){
                    $fullname = $row["first_name"].' '.$row["last_name"];

                    echo "<option value='".$row["id"]."'>".$fullname."</option>";
                });
                ?>
            </select>

            <br>

            <label for="category">Joke Category:</label><br>
            <select name="category">
                <option value="0">-- select a category --</option>
                <?php

                Repository::Instance()->retrieve_all_categories(function($result){
                    while (list($id,$category) = $result->fetch_row()){

                        echo <<<EOT
                <option value="$id">$category</option>
EOT;
                    }
                });
                ?>
            </select>

            <br>
            <br>
            <hr>

            <input type="submit" name="submit" value="Submit">
        </form>
    <?php
        }
    ?>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>