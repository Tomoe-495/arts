<?php
$current_file = basename($_SERVER['PHP_SELF']);

if(isset($_GET["login"])){
    session_destroy();
    header("location: index.php");
}
?>


<header>
    <!-- <div class="logo">LOGO</div> -->
    <img class="logo" src="uploads/logo.png" alt="logo">
    <nav>
        <a href="index.php" class='link'>Home</a>
        <a href="store.php" class='link'>Store</a>
        <a href="#" class='link'>Contact Us</a>
        <?php
        if(isset($_SESSION["username"])){
            if($_SESSION["type"] == "customer"){
                echo "<a href='#' class='link'>My Orders<a>
                <a href='#' class='link center-v'><ion-icon name='bag'></ion-icon>Cart</a>
                <a href='index.php?login=destroy' type='Logout' class='center-v link'><ion-icon name='person'></ion-icon>logout</a>";
            }else if($_SESSION["type"] == "admin"){
                echo "<a href='#' class='link'>Orders</a>
                <a href='dashboard.php' class='link'>dashboard</a>
                <a href='index.php?login=destroy' title='Logout' class='center-v link'><ion-icon name='person'></ion-icon>logout</a>";
            }else if($_SESSION["type"] == "employee"){
                echo "<a href='#' class='link'>Orders</a>
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


</script>
