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

    <div class="product-page">
        <div class="category-sidebar">
            <form class="category-form" method="GET" action="store.php">
                <h2>Categories</h2>
                <label><input type="radio" name="category" value="gift"> Gift Articles</label>
                <label><input type="radio" name="category" value="cards"> Greeting Cards</label>
                <label><input type="radio" name="category" value="dolls"> Dolls</label>
                <label><input type="radio" name="category" value="files"> Files</label>
                <label><input type="radio" name="category" value="handbags"> Hand Bags</label>
                <label><input type="radio" name="category" value="wallets"> Wallets</label>
                <label><input type="radio" name="category" value="cosmetics"> Cosmetics</label>
                <div class="submit-button-container">
                    <button type="submit" class="submit-button">Filter</button>
                </div>
            </form>
        </div>
        <div class="main-section">
            <div class="search-bar">
                <input type="search" placeholder="Search for anything" value="<?php if(isset($_GET["search"])) echo $_GET["search"] ?>" data-search>
            </div>
            <div class="product-list">
                <div class="product-card">
                    <img src="https://source.unsplash.com/300x200/?product1" alt="Product 1" class="product-image">
                    <h3 class="product-name">Product 1</h3>
                    <p class="product-price">$25</p>
                </div>
                <div class="product-card">
                    <img src="https://source.unsplash.com/300x200/?product2" alt="Product 2" class="product-image">
                    <h3 class="product-name">Product 2</h3>
                    <p class="product-price">$35</p>
                </div>
                <!-- Add more product cards here as needed -->
            </div>
        </div>
    </div>

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