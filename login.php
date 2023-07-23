<?php

if(! isset($_GET["type"]) || ! isset($_POST)){
    header("location: login.php");
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

<?php include "nav.php"?>


<form action="login.php?type=register" method="post">
    <input type="text" name="username" pattern="^[a-zA-Z0-9_]{3,20}$" placeholder="Enter Username" title="Username must be 3 to 20 characters long and can only contain letters, digits, and underscores." required>
    <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" placeholder="Enter Email" title="Please enter a valid email address." required>
    <input type="password" name="password" placeholder="Enter Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?|\-])\S{8,}$" title="Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long." required>
    <input type="submit" value="Sign up">
</form>

<form action="login.php?type=login" method="post">
    <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" placeholder="Enter Email" title="Please enter a valid email address." required>
    <input type="password" name="password" placeholder="Enter Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?|\-])\S{8,}$" title="Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long." required>
    <input type="submit" value="Log in">
</form>

<br>

<?php

if($_GET){
    if($_GET["type"] == "register"){
        
    }
}

?>

    
</body>
</html>