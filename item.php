<?php

if(! isset($_GET["id"])){
    header("location: store.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <?php include "header.php"?>
</head>
<body>

<div class="mail-notification" data-noti>
    <p data-noti-para></p>
    <ion-icon class="close-noti" name="close-outline" data-noti-close></ion-icon>
</div>

    <?php include "nav.php"?>

    <?php 
    
$id = $_GET["id"];

include "dbcon.php";

$sql = "SELECT * FROM products Where id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$product_year = $row["product_year"];
$name = $row["name"];
$price = $row["price"];
$type = $row["type"];
$description = $row["description"];
$images = explode(",",$row["img"]);

    ?>

    <div class="item-page">
        <div class="item-sect">
            
            <div class="product-images">
                <img src="uploads/products/<?php echo $images[0]?>" alt="Product Main Image" id="main-image">
                <div class="thumbnail-images">
                    <?php
                    foreach($images as $img){
                        echo "<img src='uploads/products/$img' onclick='changeImage(`uploads/products/$img`)'>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="product-details">
                <p class="product-type"><span><?php echo $type?></span></p>
                <span class="product-id">Product id:  <span><?php echo $product_year.$id?></span></span>
                <h2 class="product-name"><?php echo $name?></h2>
                <p class="product-price">Rs. <?php echo $price?></p>
                <?php
                
                if($_SESSION["type"] == "customer"){
                    echo "<form method='post' action='addcart.php?id=<?php echo $id?>' class='add-to-cart'>
                        <input name='quantity' type='number' min='1' value='1'>
                        <button class='addcart'>Add to Cart</button>
                    </form>";
                }

                ?>
                <p class='product-desc'><?php echo $description?></p>
            </div>

        </div>
    </div>

    
    <script>

function changeImage(imageUrl) {
    document.getElementById('main-image').src = imageUrl;
}

let bar = document.querySelector("[data-noti]");
let barPara = document.querySelector("[data-noti-para]");
let barClose = document.querySelector("[data-noti-close]");

let cookies = checkCookies();

let green = "#78e49c";
let red = "#e06c6c";

if(cookies["register"]){
    if(cookies["register"] == "productAdded"){
        notifition("Product has been added to cart", green)
    }
}

function notifition(msg, color){
    bar.style.backgroundColor = color;
    barPara.innerHTML = msg;
    bar.style.display = "flex";
}

barClose.addEventListener("click", () => {
    bar.style.display = "none";
})

    </script>

    <?php include "footer.php"?>

</body>
</html>