<?php  
session_start();
if(isset($_SESSION["username"])){
    header("location: index.php");
}
if(isset($_GET["type"])){
    if(! isset($_POST)){
        header("location: login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/signup</title>
    <?php include "header.php"?>
</head>
<body>

<div class="mail-notification" data-noti>
    <p data-noti-para></p>
    <ion-icon class="close-noti" name="close-outline" data-noti-close></ion-icon>
</div>

<?php include "nav.php"?>


<div class="main-content">
    <!-- Buttons to toggle between forms -->
    <div class="toggle-buttons">
        <button id="register-btn" class="button-title active">REGISTER</button>
        <span>/</span>
        <button id="login-btn" class="button-title">LOGIN</button>
    </div>

    <!-- Register Form -->
    <form id="register-form" action="login.php?type=register" method="post" class="log-form active-form registration-form">
        <input type="text" name="username" pattern="^[a-zA-Z0-9_]{3,20}$" placeholder="Enter Username" title="Username must be 3 to 20 characters long and can only contain letters, digits, and underscores." required>
        <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" placeholder="Enter Email" title="Please enter a valid email address." required>
        <input type="password" name="password" placeholder="Enter Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?|\-])\S{8,}$" title="Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long." required>
        <input type="submit" value="Sign up">
    </form>

    <!-- Login Form -->
    <form id="login-form" action="login.php?type=login" method="post" class="log-form login-form">
        <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" placeholder="Enter Email" title="Please enter a valid email address." required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="submit" value="Log in">
    </form>
</div>

<br>

<?php

if($_GET){
    if($_GET["type"] == "register"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        header("location: mail.php?type=register&username=$username&email=$email&password=$password");

    }else if($_GET["type"] == "login"){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $Password = md5($password);

        include "dbcon.php";

        $sql = "select * from accounts where email = '$email' and password = '$Password'";

        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows == 0){
            setcookie("register", "exist", time()+5);
            header("location: login.php");
        }else{
            $row = mysqli_fetch_assoc($result);

            if(! $row["verify"]){
                setcookie("register", "verify", time()+5);
                header("location: login.php");
            } 

            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["type"] = $row["type"];
            header("location: index.php");

        }

    }
}

?>

<script>

    // Get the register and login buttons
const registerBtn = document.getElementById("register-btn");
const loginBtn = document.getElementById("login-btn");

// Get the register and login forms
const registerForm = document.getElementById("register-form");
const loginForm = document.getElementById("login-form");

// Add event listeners to the buttons
registerBtn.addEventListener("click", () => {
  // Show the register form and hide the login form
  registerForm.classList.add("active-form");
  loginForm.classList.remove("active-form");
  registerBtn.classList.add("active");
  loginBtn.classList.remove("active");
});

loginBtn.addEventListener("click", () => {
  // Show the login form and hide the register form
  loginForm.classList.add("active-form");
  registerForm.classList.remove("active-form");
  loginBtn.classList.add("active");
  registerBtn.classList.remove("active");
});


let bar = document.querySelector("[data-noti]");
let barPara = document.querySelector("[data-noti-para]");
let barClose = document.querySelector("[data-noti-close]");

let cookies = checkCookies();

if(cookies["register"]){

    if(cookies["register"].includes("registered") || cookies["register"].includes("Exists")){
        bar.style.backgroundColor = "#e06c6c"; // red
    }else{
        bar.style.backgroundColor = "#78e49c"; // green
    }

    barPara.innerHTML = cookies["register"];
    bar.style.display = "flex";
}

let green = "#78e49c";
let red = "#e06c6c";

if(cookies["register"]){
    if(cookies["register"] == "verify"){
        notifition("A Verification mail has been sent to your email", green)
    }else if(cookies["register"] == "registered"){
        notifition("A User has already been registered with that email", red)
    }else if(cookies["register"] == "exist"){
        notifition("Invalid Email or Password", red);
    }else if(cookies["register"] == "verify"){
        notification("verify your email address", red);
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


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>
