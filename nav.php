<?php
$current_file = basename($_SERVER['PHP_SELF']);
?>


<header>
    <div class="logo">LOGO</div>
    <nav>
        <a href="#">Home</a>
        <a href="#">Store</a>
        <a href="#">Contact Us</a>
        <?php
        if($current_file != "login.php"){
            echo "<a href='login.php'>login / Sign up</a>";
        }
        ?>        
    </nav>
</header>    

