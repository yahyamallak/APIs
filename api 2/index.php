<?php
session_start();
header("Content-Type: application/json");

require_once 'config.php';



$output = array('flag'=>0, 'msg'=>'Invalid request');

if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

    $query = "SELECT * FROM blogs";
    $results = $conn->query($query);
    $data = [];

    while($item = $results->fetch_assoc()){ 
        $data[] = $item;
    }

    if(count($data) > 0){
        $output['data'] = $data;
        $output['flag'] = 1;
        $output['msg'] = '';
    } else {
        $output['flag'] = 0;
        $output['msg'] = 'No Data';
    }
} else {
    $output['flag'] = 0;
    $output['msg'] = "You don't have permission";
}

echo json_encode($output);