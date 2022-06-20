<?php

$conn = mysqli_connect("localhost", "root", "", "blog_api");

if(mysqli_connect_errno()){
    die("Failed to connect" . mysqli_connect_error());
}