<?php

/**
 * HTTP Headers
 */

header("Access-Control-Allow-Origin: *"); // All websites have access

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: *"); // GET / POST / PUt etc...

header("Access-Control-Max-Age: 3600"); // Caching 3600 seconds

header("Access-Control-Allow-Headers: *"); // 


if(isset($_GET['key'])){
    if($_GET['key'] == 'A@x2B6py1za@1a'){

        $username = "root";
        $password = "";
        $database = new PDO("mysql:host=localhost; dbname=api;charset=utf8", $username, $password);

        $items = $database->prepare("SELECT * FROM students");
        $items->execute();

        $items = $items->fetchAll(PDO::FETCH_ASSOC);

        print_r(json_encode($items));
    } else {
        echo 'The API key is incorrect !';
    }
}

