<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <?php include "header.php" ?>
</head>
<body>

<div class="mail-notification" data-noti>
    <p data-noti-para></p>
    <ion-icon class="close-noti" name="close-outline" data-noti-close></ion-icon>
</div>

    <?php include "nav.php" ?>

    <section class="products-section">
        <div class="search-bar">
            <input type="search" placeholder="Search for anything" value="<?php if(isset($_GET["search"])) echo $_GET["search"] ?>" data-search>
        </div>
        
        <div class="product-list">
            <!-- Sample Product Cards -->


            <?php
            
            include "dbcon.php";

            if(isset($_GET["search"])){
                $search = $_GET["search"];
                $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
            }else{
                $sql = "SELECT * FROM products ORDER BY rand()";
            }

            $result = mysqli_query($conn, $sql);
            $numRows = mysqli_num_rows($result);

            if($numRows == 0){
                echo "<h1 class='no-emp'>nothing found</h1>";
            }

            while($row = mysqli_fetch_assoc($result)){
                $id = $row["id"];
                $product_year = $row["product_year"];
                $name = $row["name"];
                $price = $row["price"];
                $description = $row["description"];
                $images = $row["img"];
                $img = strpos($images, ',') !== false ? explode(',', $images)[0] : $images;

                $cart_btn = "";
                if(! isset($_SESSION["type"])){
                    $cart_btn = "<a href='addcart.php?id=$id' class='p-add'><ion-icon name='bag-add'></ion-icon></a>";
                }else if($_SESSION["type"] == "customer"){
                    $cart_btn = "<a href='addcart.php?id=$id' class='p-add'><ion-icon name='bag-add'></ion-icon></a>";
                }

                echo "<div class='product-card'>".
                        $cart_btn
                        ."<a href='item.php?id=$id'>
                            <img src='uploads/products/$img'>
                        </a>
                        <a href='item.php?id=$id'>
                            <p class='p-name'>$name</p>
                        </a>
                        <p class='price'>Rs. $price</p>
                    </div>";
            }

            ?>

        </div>
    </section>

    <script>

const search = document.querySelector("[data-search]");

search.addEventListener("keypress", (event) => {
    if(event.key == "Enter"){
        let word = search.value;
        word == "" ? location.href = "store.php" : location.href = "store.php?search="+word;
    }
})

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