<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Arts</title>
        <?php include "header.php"?>
    </head>
    <body>

<div class="mail-notification" data-noti>
    <p data-noti-para></p>
    <ion-icon class="close-noti" name="close-outline" data-noti-close></ion-icon>
</div>

    <?php include "nav.php"?>

    <section class="landing-section">
        <div class="landing-content">
            <h2 class="label">Welcome to Our Store</h2>
            <h1 class="huge-heading">Discover Amazing Products</h1>
            <a href="store.php" class="cta-button">Shop Now</a>
        </div>
    </section>

    <section class="features-section">
        <div class="feature-card">
            <ion-icon name="gift"></ion-icon>
            <div class="f-desc">
                <h3>Quality Products</h3>
                <p>Discover a wide range of high-quality products.</p>
            </div>
        </div>
        <div class="feature-card">
            <ion-icon name="airplane"></ion-icon>
            <div class="f-desc">
                <h3>Free Shipping</h3>
                <p>Enjoy free shipping on all orders.</p>
            </div>
        </div>
        <div class="feature-card">
            <ion-icon name="cash"></ion-icon>
            <div class="f-desc">
                <h3>100% Money Back</h3>
                <p>Not satisfied? We offer a money-back guarantee.</p>
            </div>
        </div>
    </section>

    <section class="interested-section">
        <div class="interested-content">
            <h2 class="interested-title">Explore Our Collection</h2>
            <p class="interested-description">
                Discover our amazing products and explore a world of possibilities. Whether it's gifts, accessories, or more, we have something for everyone.
            </p>
            <a href="store.php" class="interested-button">Explore Now</a>
        </div>
    </section>

    <section class="help-section">
        <div class="help-content">
            <div class="help-left">
                <h2 class="help-title">Need Help?</h2>
                <a href="contact.php" class="help-button">
                    <ion-icon name="call"></ion-icon>
                    Contact Us
                </a>
            </div>
            <p class="help-description">
                If you have any questions or need assistance, our friendly support team is here to help. We provide quick and reliable solutions to ensure a seamless experience. Whether it's product information, technical issues, or general inquiries, feel free to reach out. Your satisfaction is our priority.
            </p>
        </div>
    </section>


    <?php include "footer.php"?>

    <script>


let bar = document.querySelector("[data-noti]");
let barPara = document.querySelector("[data-noti-para]");
let barClose = document.querySelector("[data-noti-close]");

let cookies = checkCookies();
let green = "#78e49c";
let red = "#e06c6c";

if(cookies["order"]){
    if(cookies["order"] == "placed"){
        notifition("Your orders have been placed", green)
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

    </body>
</html>