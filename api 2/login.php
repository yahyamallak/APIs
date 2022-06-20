<?php
session_start();
header("Content-Type: application/json");

require_once 'config.php';

$output = array('flag'=>0);

if(isset($_POST['username']) && isset($_POST['password'])){
    $query = "SELECT * from users WHERE user_name = '".$_POST['username']."' and user_password='".sha1($_POST['password'])."'";

    $res = $conn->query($query);

    if($res->num_rows == 1){
        $_SESSION['username'] = $_POST['username'];
        $output['flag'] = 1;
    }
}

echo json_encode($output);