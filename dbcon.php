<?php

// for linux
$servername = "Tomoe";

// for windows
// $servername = "localhost";

$username = "root";
$password = "";
$database = "arts";

$conn = mysqli_connect($servername, $username, $password, $database);

//  it's working fine

// if($conn){
//     echo "connected";
// }else{
//     echo "not connected";
// }

