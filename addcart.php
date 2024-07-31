<?php
session_start();

if(! isset($_SESSION["id"])){
    header("location: login.php");
}else if(! isset($_GET["id"])){
    header("location; index.php");
}

if($_POST){
    $quantity = $_POST["quantity"];
}else{
    $quantity = 1;
}

$c_id = $_SESSION["id"];
$p_id = $_GET["id"];

include "dbcon.php";

$sql = "SELECT * from cart where product_id = $p_id and customer_id = $c_id";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);

if($numRows > 0){
    $row = mysqli_fetch_assoc($result);
    $id = $row["id"];
    $quantity = $row["quantity"];
    $quantity += 1;

    $sql = "UPDATE cart set quantity = $quantity where id = $id";
}else{
    $sql = "INSERT INTO cart(product_id, customer_id, quantity) values($p_id, $c_id, $quantity)";
}


mysqli_query($conn, $sql);
setcookie("register", "productAdded", time()+5);

if($_POST){
    header("location: item.php?id=$p_id");
}else{
    header("location: store.php");
}

?>