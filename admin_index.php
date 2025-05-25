<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: admin_login.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="index.css">
    <title>Admin Profile</title>
</head>

<body>
<header class="head">
        <div class="logo">
            <a href="http:">
                <img src="ucpc-dark.png" alt="UCPC Logo" class="logo">
            </a>
        </div>
        <div class="navbar">           
            <a class="nav-link nav-link-grow-up" href="users.php">General Members</a>    
            <a class="nav-link nav-link-grow-up" href="rec_event_mngmnt.php">Recent Events</a>                                                                     
            <a class="nav-link nav-link-grow-up" href="up_event_mngmnt.php">Upcoming Events</a>    
            <a class="nav-link nav-link-grow-up" href="event_reg_list.php">Event Reg. List</a>                                                                     
            <a class="nav-link nav-link-grow-up" href="admin_logout.php">Logout</a>                                                                     

        </div>
    </header> 
    <br><br><br>
    <center><h1 style="color:#0d1b50">Logged In as Admin Successfully!</h1> </center> 
</body> 
</html>