<?php
$current_file = basename($_SERVER['PHP_SELF']);

if(isset($_GET["login"])){
    session_destroy();
    header("location: index.php");
}

if(isset($_GET["remove"])){
    include "dbcon.php";
    $r_id = $_GET["remove"];
    $sql = "delete from cart where id = $r_id";
    mysqli_query($conn, $sql);
    $file = $_GET["file"];
    setcookie("cart", "remove", time()+5);
    header("location: $file");
}else if(isset($_POST["quantity"])){
    $quantity = $_POST["quantity"];
    $cart_id = $_GET["id"];
    $file = $_GET["file"];
    include "dbcon.php";
    if($quantity == 0){
        $sql = "delete from cart where id = $cart_id";
    }else{
        $sql = "update cart set quantity = $quantity where id = $cart_id";
    }
    mysqli_query($conn, $sql);
    setcookie("cart", "remove", time()+5);
    header("location: $file");
}

$total_price = 0;

?>

<div class="modal" data-modal>
    <ion-icon name="close" class='close' data-modal-close></ion-icon>
    <div class="cart-sect">

        <?php 
        
        if(isset($_SESSION["id"])){
            $user_id = $_SESSION["id"];

            
            include "dbcon.php";

            $sql = "SELECT * from cart where customer_id = $user_id";
            $result = mysqli_query($conn, $sql);
            $numRows = mysqli_num_rows($result);

            if($numRows == 0){
                echo "<h1 class='no-emp'>nothing in the card</h1>
                <br>
                <a href='store.php' class='cart-btn'>Go Shop</a>";
            }

            while($row = mysqli_fetch_assoc($result)){
                $cart_id = $row["id"];
                $p_id = $row["product_id"];

                $sql = "SELECT * from products where id = $p_id";
                $p_result = mysqli_query($conn, $sql);
                $p_row = mysqli_fetch_assoc($p_result);

                $images = $p_row["img"];
                $img = strpos($images, ',') !== false ? explode(',', $images)[0] : $images;
                $name = $p_row["name"];
                $price = $p_row["price"];
                $quantity = $row["quantity"];
                $total = $price * $quantity;

                $cart_item = "<div class='cart-item'>
                    <img src='uploads/products/$img'>
                    <div class='item-details'>
                        <h3>$name</h3>
                        <p>Price: Rs. $price</p>
                        <p>Total Price: Rs. $total</p>
                    </div>
                    <form method='post' action='nav.php?file=$current_file&id=$cart_id' class='item-quantity'>
                        <input type='number' name='quantity' value='$quantity' min='0'>
                        <button type='submit' class='update-btn'>Update</button>
                    </form>
                    <a href='nav.php?file=$current_file&remove=$cart_id' class='remove-btn'>
                        <ion-icon name='trash'></ion-icon>
                    </a>
                </div>";
                $total_price += $total;
                echo $cart_item;
            }

            if($numRows > 0){
                echo  "<form method='post' action='placeorder.php?order=all' class='cart-total'>
                        <p><span>Total Price:</span> <span> Rs. $total_price</span></p>
                        <button type='submit' class='place-order-btn'>Place Order</button>
                    </form>";
            }

        }

        ?>


    </div>
</div>


<header>
    <!-- <div class="logo">LOGO</div> -->
    <img class="logo" src="uploads/logo.png" alt="logo">
    <nav>
        <a href="index.php" class='link'>Home</a>
        <a href="store.php" class='link'>Store</a>
        <a href="contact.php" class='link'>Contact Us</a>
        <?php
        if(isset($_SESSION["username"])){
            if($_SESSION["type"] == "customer"){
                echo "<a href='orders.php' class='link'>My Orders<a>
                <a href='dashboard.php' class='link'>Account</a>
                <a class='link center-v' data-cart-btn><ion-icon name='bag'></ion-icon>Cart</a>
                <a href='index.php?login=destroy' type='Logout' class='center-v link'><ion-icon name='person'></ion-icon>logout</a>";
            }else if($_SESSION["type"] == "admin"){
                echo "<a href='orders.php' class='link'>Orders</a>
                <a href='dashboard.php' class='link'>dashboard</a>
                <a href='index.php?login=destroy' title='Logout' class='center-v link'><ion-icon name='person'></ion-icon>logout</a>";
            }else if($_SESSION["type"] == "employee"){
                echo "<a href='orders.php' class='link'>Orders</a>
                <a href='dashboard.php' class='link'>dashboard</a>
                <a href='index.php?login=destroy' title='Logout' class='center-v link'>
                    <ion-icon name='person'></ion-icon>logout
                </a>";
            }
        }
        else if($current_file != "login.php"){
            echo "<a href='login.php' class='link'>login / Sign up</a>";
        }
        ?>        
    </nav>
    <div class="hamburger">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
</header>    


<div class="themebar" data-themebar>
    <ion-icon name='brush' data-accent-btn></ion-icon>
    <div class="theme-sect">
        <p>Color Switcher</p>
        <div class="themes">
            <div class="box1" onclick="changeAccent('#db2121')"></div>
            <div class="box2" onclick="changeAccent('#1d67c7')"></div>
            <div class="box3" onclick="changeAccent('#e6c925')"></div>
            <div class="box4" onclick="changeAccent('#921ec0')"></div>
        </div>        
    </div>
</div>


<script>
try{

    const cartBtn = document.querySelector("[data-cart-btn]");
    const cart = document.querySelector("[data-modal]")
const cartclose =document.querySelector("[data-modal-close]");

cartclose.addEventListener("click", () => {
    cart.style.right = "-100%";
})

document.addEventListener('click', function(event) {
  const cartSect = document.querySelector('.cart-sect');

  if (cart.contains(event.target) && !cartSect.contains(event.target)) {
    cart.style.right = "-100%";
  }
});

cartBtn.addEventListener("click", () => {
    cart.style.right = "0";
})

}catch{
    
}
document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
  const navLinks = document.querySelector("nav");
  
  hamburger.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    hamburger.classList.toggle("active")
  });
});


const btn = document.querySelector("[data-accent-btn]");
const themebar = document.querySelector("[data-themebar]");

btn.addEventListener("click", () => {
    themebar.classList.toggle("active");
})

var cookie = checkCookies();

if(cookie["cart"]){
    cart.style.right = "0";
}


</script>
