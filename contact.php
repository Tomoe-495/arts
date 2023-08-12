<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php include "header.php"?>
</head>
<body>
<div class="mail-notification" data-noti>
    <p data-noti-para></p>
    <ion-icon class="close-noti" name="close-outline" data-noti-close></ion-icon>
</div>
<?php include "nav.php"?>

<div class="contact-us">
    <div class="contact-details">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <div class="info-item">
                <ion-icon name="location"></ion-icon>
                <p>1234 Street Ave<br>City, Country</p>
            </div>
            <div class="info-item">
                <ion-icon name="mail"></ion-icon>
                <p>info@arts.com</p>
            </div>
            <div class="info-item">
                <ion-icon name="call"></ion-icon>
                <p>+1 (234) 567-890</p>
            </div>
        </div>
    </div>
    <div class="contact-form">
        <h2>Get in Touch</h2>
        <form action="mail.php?type=contact" method="POST">
            <input type="text" name='username' pattern="^.{3,20}$" title="Keep the username from 3-20 characters" placeholder="Your Name" required>
            <input type="email" name='email' pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Your Email" required>
            <input type="text" name='subject' placeholder="Subject" required>
            <textarea data-chr placeholder="Your Message" name='message' rows="6" required></textarea>
            <span data-length></span>
            <button type="submit">Send Message</button>
        </form>
    </div>
</div>


<script>

let chr =document.querySelector("[data-chr]");
let span =document.querySelector("[data-length]");
let maxlength = 250;

chr.setAttribute("maxlength", maxlength);

chr.addEventListener("keypress", () => {
    let length = chr.value.length;

    span.innerHTML = `Characters: ${maxlength - length}`;
})


let bar = document.querySelector("[data-noti]");
let barPara = document.querySelector("[data-noti-para]");
let barClose = document.querySelector("[data-noti-close]");

let cookies = checkCookies();
let green = "#78e49c";
let red = "#e06c6c";

if(cookies["register"]){
    if(cookies["register"] == "sent"){
        notifition("Your message has been sent", green)
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