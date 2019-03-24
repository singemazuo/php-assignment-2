<?php //session_start();

function confirm_logged_in() {
    if (empty($_SESSION['username'])){
        redirect_to('login.php?message=2');
    }
}

function confirm_logged_in_as_admin(){
    if (empty($_SESSION['username'])){
        if ($_SESSION['usertype'] != 'admin'){
            redirect_to('login.php?message=3');
        }else{

        }
    }
}