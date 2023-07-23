<?php

// for linux
$servername = "Tomoe";
$username = "root";

// for windows
// $servername = "root";
// $username = "localhost";

$password = "";
$database = "arts";

$conn = mysqli_connect($servername, $username, $password, $database);

if($conn){
    echo "connected";
}else{
    echo "not connected";
}

?>