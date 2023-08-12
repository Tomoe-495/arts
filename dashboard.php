<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include "header.php"?>
</head>
<body>

<div class="mail-notification" data-noti>
    <p data-noti-para></p>
    <ion-icon class="close-noti" name="close-outline" data-noti-close></ion-icon>
</div>

<?php
include "nav.php";

$error_msg = "";

// adding the employee here
if(isset($_POST["newpass"])){
    $newpass = $_POST["newpass"];
    $repass = $_POST["repass"];

    if($newpass == $repass){
        $id = $_SESSION["id"];
        $pass = md5($newpass);
        include "dbcon.php";
        $sql = "UPDATE accounts set password = '$pass' where id = $id";
        mysqli_query($conn, $sql);
        setcookie("register", "passreset", time()+5);
        header("location: dashboard.php");
    }else{
        $error_msg = "password don't match";
    }

}else if(isset($_POST["username"])){
    $Username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Password = md5($password);

    include "dbcon.php";

    $sql = "INSERT into accounts(username, email, password, type, verify) values
    ('$Username', '$email', '$Password', 'employee', 1)";

    $result = mysqli_query($conn, $sql);

    if($result){
        setcookie("register", "added", time()+5);
        header("location: dashboard.php");
    }
}else if(isset($_GET["delete"])){
    $id = $_GET["delete"];
    include "dbcon.php";

    $sql = "DELETE FROM accounts where id = $id";

    $result = mysqli_query($conn, $sql);
    if($result){
        setcookie("register", "removed", time()+5);
        header("location: dashboard.php");
    }
}

?>

<div class="dash-container">

    <div class="d-sidebar">
        <?php
            if($_SESSION["type"] == "admin"){
                echo "<button class='active' data-all-btn>View Employees</button>
                <button data-emp-btn>Add Employee</button>
                <button data-pass-btn>Change Password</button>";
            }else if($_SESSION["type"] == "customer" || $_SESSION["type"] == "employee"){
                echo "<button class='active' data-pass-btn>Change Password</button>";
            }
        ?>
    </div>

    <div class="d-mainbar">

        <div class="change-password">
            <h2>Change Password</h2>
            <form action='dashboard.php' method='post'>
                <input type="password" name='newpass' placeholder="New Password" pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?|\-])\S{8,}$' required>
                <input type="password" name='repass' placeholder="Re-type Password" required>
                <span class="pass-error"><?php echo $error_msg?></span>
                <button type="submit">Change Password</button>
            </form>
        </div>



        <?php
        
        if($_SESSION["type"] == "admin"){
            echo "<div class='employees active sect' data-all>
                <table class='employee-table'>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created On</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>";

                        
                        include "dbcon.php";

                        $sql = "SELECT * FROM accounts where type = 'employee'";

                        $result = mysqli_query($conn, $sql);
                        $numRows = mysqli_num_rows($result);

                        if($numRows != 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row["id"];
                                $username = $row["username"];
                                $email = $row["email"];
                                $created = $row["created_int"];
                                
                                $t_row = "<tr>    
                                        <td>$username</td>
                                        <td>$email</td>
                                        <td>$created</td>
                                        <td><a href='dashboard.php?delete=$id'>Delete</a></td>
                                    </tr>";
                                echo $t_row;
                            }
                        }


            echo   "</tbody>
                </table>";
                
                if($numRows == 0){
                    echo "<h1 class='no-emp'>There are no Employees</h1>";
                }

            echo "</div>";
            
            
            echo "<div class='addemployee sect' data-emp>
                
            <div class='d-form-sect'>
                <form action='dashboard.php' method='post'>
                    <input type='text' name='username' pattern='^[a-zA-Z0-9_]{3,20}$' placeholder='Enter Username' title='Username must be 3 to 20 characters long and can only contain letters, digits, and underscores.' required>
                    <input type='email' name='email' pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}' placeholder='Enter Email' title='Please enter a valid email address.' required>
                    <input type='password' name='password' placeholder='Enter Password' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?|\-])\S{8,}$' title='Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long.' required>
                    <input type='submit' value='add Employee'>
                </form>
            </div>
            
        </div>";
    }

    ?>

    </div>
</div>



<script>

switchPanel('data-all-btn', 'data-all');
switchPanel('data-emp-btn', 'data-emp');

function switchPanel(btn, sect){
    document.querySelector(`[${btn}]`).addEventListener("click", () => {
        for(let s of document.querySelectorAll(".sect")){
            s.classList.remove("active");
        }
        for(let b of document.querySelectorAll("button")){
            b.classList.remove("active");
        }
        document.querySelector(`[${sect}]`).classList.add("active");
        document.querySelector(`[${btn}]`).classList.add("active");
    })
}

let bar = document.querySelector("[data-noti]");
let barPara = document.querySelector("[data-noti-para]");
let barClose = document.querySelector("[data-noti-close]");

let green = "#78e49c";
let red = "#e06c6c";
let cookies = checkCookies();

if(cookies["register"]){

    if(cookies["register"] == "added"){
        notifition("Employee has been added", green);
    }else if(cookies["register"] == "removed"){
        notifition("Employee has been removed", red);
    }else if(cookies["register"] == "passreset"){
        notifition("password has been changed", green);
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