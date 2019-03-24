<?php

include_once "open_connection.php";
include_once "functions.php";

class Repository{
    private $link;

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Repository();
        }
        return $inst;
    }

    private function __construct(){
        $this->link = make_connection('joker');
    }

    public function login($username,$password,callable $callback){
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        $result = $this->link->query($query);
        if ($row = $result->fetch_assoc()){
            if(compare_password($password,$row["password"])){
                if($callback)$callback($row["id"],$row["first_name"],$row["last_name"],$row["user_type"]);
            }else{
                if($callback)$callback();
            }
        }else{
            if($callback)$callback();
        }

        $result->close();
    }

    public function add_new_user($fname,$lname,$uname,$pwd,$utype,$email,$img,callable $callback){
        $pwd = encrypt_password($pwd);

        $query = "INSERT INTO users (first_name,last_name,username,password,email,avatar,user_type) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->link->prepare($query);
        $stmt->bind_param("sssssss",$fname,$lname,$uname,$pwd,$email,$img,$utype);

        $succeed = $stmt->execute();
        if($succeed){
            if($callback)$callback($stmt->insert_id);
        }else{
            if($callback)$callback(null);
        }
    }

    public function retrieve_user_details($uid,callable $callback){
        $sql = "SELECT * FROM users WHERE id = ".$uid;
        $result = $this->link->query($sql);

        while ($row = $result->fetch_assoc()){
            if (!empty($callback)) {
                $callback($row);
            }
        }

        $result->close();
    }

    public function retrieve_all_jokes($callback){
        $sql = "SELECT * FROM jokes";
        $result = $this->link->query($sql);

        if (!empty($callback)) {
            $callback($result);
        }

        $result->close();
    }

    public function retrieve_all_users(callable $callback) {
        $sql = "SELECT * FROM users WHERE user_type = 'User'";
        $result = $this->link->query($sql);

        while($row = $result->fetch_assoc()){
            if (!empty($callback)) {
                $callback($row);
            }
        }

        $result->close();
    }

    public function retrieve_all_categories($callback){
        $sql = "SELECT * FROM categories";
        $result = $this->link->query($sql);

        if (!empty($callback)) {
            $callback($result);
        }

        $result->close();
    }

    public function insert_joke($title,$teaser,$text,$author,$category,$callback) {
        $sql = "INSERT INTO jokes (title,teaser,joke_text,visible,user_id,category_id) VALUES (?,?,?,0,?,?)";
        $stmt = $this->link->prepare($sql);
        $stmt->bind_param("sssii",$title,$teaser,$text,$author,$category);
        $result = $stmt->execute();

        if (!empty($callback)) {
            $callback($stmt->insert_id,$result);
        }

        $stmt->close();
    }
}