<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <?php include "header.php" ?>
</head>
<body>
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
                $sql = "SELECT * FROM products";
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

                echo "<a href='item.php?id=$id' class='product-card'>
                        <img src='uploads/products/$img'>
                        <p class='p-name'>$name</p>
                        <p class='price'>Rs. $price</p>
                    </a>";
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

    </script>
    
    <?php include "footer.php"?>

</body>
</html>