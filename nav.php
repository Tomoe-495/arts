<?php
$current_file = basename($_SERVER['PHP_SELF']);

if(isset($_GET["login"])){
    session_destroy();
    header("location: index.php");
}
?>


<header>
    <div class="logo">LOGO</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="#">Store</a>
        <a href="#">Contact Us</a>
        <?php
        if(isset($_SESSION["username"])){
            if($_SESSION["type"] == "customer"){
                echo "<a href='#'>My Orders<a>
                <a href='#'><ion-icon name='bag'></ion-icon></a>
                <a href='index.php?login=destroy' type='Logout' class='center-v'><ion-icon name='person'></ion-icon>logout</a>";
            }else if($_SESSION["type"] == "admin"){
                echo "<a href='#'>Orders</a>
                <a href='dashboard.php'>dashboard</a>
                <a href='index.php?login=destroy' title='Logout' class='center-v'><ion-icon name='person'></ion-icon>logout</a>";
            }else if($_SESSION["type"] == "employee"){
                echo "<a href='#'>Orders</a>
                <a href='index.php?login=destroy' title='Logout' class='center-v'><ion-icon name='person'></ion-icon>logout</a>";
            }
        }
        else if($current_file != "login.php"){
            echo "<a href='login.php'>login / Sign up</a>";
        }
        ?>        
    </nav>
</header>    

