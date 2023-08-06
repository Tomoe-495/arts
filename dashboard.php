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
if($_SESSION["type"] != "admin"){
    header("location: index.php");
}
include "nav.php";
?>

<div class="dash-container">
    <div class="d-sidebar">
        <button class='active' data-all-btn>View Employees</button>
        <button data-emp-btn>Add Employee</button>
    </div>
    <div class="d-mainbar">
        <div class="employees active sect" data-all>

        </div>
        <div class="addemployee sect" data-emp>

            <div class="d-form-sect">
                <form action="dashboard.php" method="post">
                    <input type="text" name="username" pattern="^[a-zA-Z0-9_]{3,20}$" placeholder="Enter Username" title="Username must be 3 to 20 characters long and can only contain letters, digits, and underscores." required>
                    <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" placeholder="Enter Email" title="Please enter a valid email address." required>
                    <input type="password" name="password" placeholder="Enter Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?|\-])\S{8,}$" title="Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long." required>
                    <input type="submit" value="add Employee">
                </form>
            </div>
                
        </div>
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

</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    
</body>
</html>