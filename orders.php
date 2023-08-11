<?php

if($_POST){
    $o_id = $_GET["id"];
    $status = $_POST["status"];
    $courier = $_POST["courier"];

    include "dbcon.php";
    $sql = "UPDATE orders set status = '$status', courier_number = '$courier' where id = $o_id";
    mysqli_query($conn, $sql);
    header("location: orders.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <?php include "header.php";
    
    if(! isset($_SESSION["id"])){
        header("location: index.php");
    }
    ?>
</head>
<body>

    <?php include "nav.php"?>

    <div class="orders-page">

    <?php
    
    $id = $_SESSION["id"];
    if($_SESSION["type"] != "customer"){
        $sql = "SELECT * from orders";
    }else{
        $sql = "SELECT * from orders where customer_id = $id";
    }

    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if($numRows == 0){
        echo "<h1 class='no-emp'>No Orders</h1>";
    }

    while($row = mysqli_fetch_assoc($result)){
        $o_id = $row["id"];
        $p_id = $row["product_id"];
        $quantity = $row["quantity"];
        $status = $row["status"];
        $courier = $row["courier_number"];
        // $courier = ($courier == "") ? "N/A" : $courier;
        $type = $row["delivery_type"];

        $sql = "SELECT * from products where id = $p_id";
        $p_result = mysqli_query($conn, $sql);
        $p_row = mysqli_fetch_assoc($p_result);

        $product_year = $p_row["product_year"];
        $images = $p_row["img"];
        $img = strpos($images, ',') !== false ? explode(',', $images)[0] : $images;
        $name = $p_row["name"];
        $price = $row["price"];

        $order_no = $type.$o_id.$product_year.$p_id;

        if($_SESSION["type"] == "admin"){
            $order = "<div class='order'>
                    <div class='order-number'>Order Number: $order_no</div>
                        <div class='order-details'>
                        <img src='uploads/products/$img'>
                        <div class='product-info'>
                            <h3>$name</h3>
                        <p>Total Price: Rs. $price</p>
                        <form method='post' action='orders.php?id=$o_id' class='admin-options'>
                            <select name='status' value='$status'>
                                <option value='order pending' " . ($status == 'order pending' ? 'selected' : '') . ">Order Pending</option>
                                <option value='processing order' " . ($status == 'processing order' ? 'selected' : '') . ">Processing Order</option>
                                <option value='out for delivery' " . ($status == 'out for delivery' ? 'selected' : '') . ">Out for Delivery</option>
                                <option value='delivered' " . ($status == 'delivered' ? 'selected' : '') . ">Delivered</option>
                            </select>
                            <input type='text' name='courier' value='$courier' placeholder='Courier Number'>
                            <button type='submit' class='update-btn'>Update</button>
                        </form>
                    </div>
                    </div>
                </div>";
        }else{

            $order = "<div class='order'>
                        <div class='order-number'>Order Number: $order_no</div>
                        <div class='order-details'>
                            <img src='uploads/products/$img'>
                            <div class='product-info'>
                                <h3>$name</h3>
                                <p>Total Price: Rs. $price</p>
                                <p>Order Status: $status</p>
                                <p>Courier Number: $courier</p>
                            </div>
                        </div>
                    </div>";
        }
        
        echo $order;
    }



    ?>

    </div>



    <?php include "footer.php"?>
    
</body>
</html>