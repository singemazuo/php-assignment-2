<?php

function make_connection($db){
    $link = new mysqli('localhost','inClass','secure', $db);

    if ($link->errno) {
        echo  "Unable to connect to the database: ".$link->error;
        exit();
    }

    if (!$link) {
        die("Connection failed ".$link->error);
    }
    return $link;
}


/* to kill a thread completely
$thread_id = $link->thread_id;
$link->kill($thread_id); */


