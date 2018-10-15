<?php

include "db_config.php";

class User {

    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.";
            exit;
        }
    }

    /*     * * for registration process ** */

    public function reg_user($username, $email, $password, $profpic) {        
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username='$username' OR emailid='$email'";
        //echo $sql;
        //checking if the username or email is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;
        //echo $count_row;
        //if the username is not in db then insert to the table
        if ($count_row == 0) {
            $sql_register = "INSERT INTO users SET username='$username', password='$password', emailid='$email', photo='$profpic'";
            $result = mysqli_query($this->db, $sql_register) or die(mysqli_connect_errno() . "Data cannot inserted");
            
            return $result;
        } else {
            return false;
        }
    }

    /*     * * for login process ** */

    public function check_login($emailusername, $password) {
        

        $password = md5($password);
        //echo $password;
        $sql_login = "SELECT uid from users WHERE username='$emailusername' and password='$password'";

        //checking if the username is available in the table
        $result = mysqli_query($this->db, $sql_login);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;
        //echo $count_row;
        if ($count_row == 1) {
            // this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['uid'];
            $_SESSION['uname'] = $emailusername;
            return true;
        } else {
            return false;
        }
    }

    /*     * * for showing the username or fullname ** */

//    public function get_fullname($uid) {
//        $sql3 = "SELECT fullname FROM users WHERE uid = $uid";
//        $result = mysqli_query($this->db, $sql3);
//        $user_data = mysqli_fetch_array($result);
//        echo $user_data['fullname'];
//    }

    /*     * * starting the session ** */

    public function get_session() {
        return $_SESSION['login'];
    }

    public function user_logout() {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }
    
//     public function isUserExist($emailid,$username){            
//            $check_sql = "SELECT * FROM users WHERE emailid = '$emailid'"; 
//            $result = mysqli_query($this->db, $check_sql);
//            $user_result = mysqli_fetch_array($result);
//            echo "<pre />";
//            var_dump($user_result);
//            $row = $user_result->num_rows;  
//            if($row > 0){  
//                return true;  
//            } else {  
//                return false;  
//            }  
//        }  

}
