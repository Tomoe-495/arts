<?php

session_start();


if($_GET){
    include "dbcon.php";
    $id = $_SESSION["id"];

    $sql = "SELECT * from cart where customer_id = $id";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $c_id = $row["customer_id"];
        $p_id = $row["product_id"];
        $quantity = $row["quantity"];

        $sql = "INSERT INTO orders(customer_id, product_id, quantity) vaues($c_id, $p_id, $quantity)";

        mysqli_query($conn, $sql);

    }

    setcookie("order", "placed", time()+5);
    header("location: index.php");

}



?>