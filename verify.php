<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <?php include "header.php" ?>
</head>
<body>

<div class="verify-page">

    <div class="verify-sect">
        
        <?php

if(! isset($_GET["token"])){
    header("location: index.php");
}

$id = $_GET["id"];
$token = $_GET["token"];

include "dbcon.php";

$sql = "SELECT * FROM accounts WHERE id = $id AND verification_token = '$token'";

$result = mysqli_query($conn, $sql);

$rows = mysqli_num_rows($result);

if($rows > 0){
    $sql = "UPDATE accounts SET verify = 1 WHERE id = $id";
    mysqli_query($conn, $sql);
    echo "
    <p>Account Verified</p>
    <span>you can login now</span>
    <button>
        <a href='login.php'>Go To Login Page</a>
    </button>";
}else{
    echo "<p>Invalid Verification credentials</p>";
}

?>
    </div>
    
</div>

</body>
</html>