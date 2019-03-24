<?php
/**
 * Created by PhpStorm.
 * User: singemazuo
 * Date: 2019-02-05
 * Time: 14:37
 */
//
//function test_input($data){
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
//}

//function login($link,$username,$password){
//    $sql = "SELECT id,username,password FROM login WHERE username = $username";
//    $result = $link->query($sql);
//
//    while ($row = $result->fetch_row()){
//        if ($password == $row[2]){
//            $_SESSION["username"] = $row[1];
//            $_SESSION["id"] = $row[0];
//            return true;
//        }
//        return false;
//    }
//}

function redirect_to($location){
    header("Location: $location");
}

function session_set($name, $data, $expire = 60*60){
    $savePath = './session_save_dir/';
    $lifeTime = $expire;
    session_save_path($savePath);
    session_set_cookie_params($lifeTime);
    session_start();

    $_SESSION[$name] = $data;
}

function encrypt_password($password){
    return password_hash($password,PASSWORD_DEFAULT);
}

function compare_password($password,$hash){
    return password_verify($password,$hash);
}

function upload_image($upfile){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES[$upfile]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES[$upfile]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES[$upfile]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return null;
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$upfile]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return null;
        }
    }
}