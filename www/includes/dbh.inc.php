<?php

// $servername = "localhost";
// $dbUsername = "user";
// $dbPassword = "test";
// $dbName = "suportebd";
//
// $conn = mysqli_connect($servername, $dbUsername, $dbPassword,$dbName);

$conn = mysqli_connect('db', 'user', 'test', "suportebd");

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}
