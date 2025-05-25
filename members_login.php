<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: members_index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="members.css">
    <link rel="stylesheet" href="form_format.css">
    <link rel="stylesheet" href="_style_.css">

    
</head>
<body>
<div class="heading">
        <header class="head">
            <div class="logo">
                <a href="http://localhost/Design-Project/index.html">
                    <img src="ucpc-dark.png" alt="UCPC Logo" class="logo">
                </a>
            </div>
            <div class="navbar">
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/index.html">Home</a>
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/events.php">Recent Events</a>
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/up-events.php">Upcoming Events</a>
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/mvo.html">Vision</a>
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/excutives.html">Executives</a>
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/Member_Registration.php">Join UCPC</a>
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/members_login.php">LogIn</a>
                <!-- <div class="dropdown">
                    <button class="nav-link nav-link-grow-up dropbtn">Login</button>
                    <div class="dropdown-content">
                       <a href="http://localhost/Design-Project/admin_login.php">Admin</a>
                       <a href="http://localhost/Design-Project/members_login.php">General Member</a>
                    </div>
                </div> -->
            </div>
        </header>   
    </div>
    <div class="body">
        <div class="container">
            <?php
            if (isset($_POST["login"])) {
            $Student_ID = $_POST["id"];
            $Password = $_POST["password"];
                require_once "members_database.php";
                $sql = "SELECT * FROM members WHERE Student_ID = '$Student_ID'";
                // $sql2 = "SELECT * FROM members WHERE email = '$Email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($Password, $user["Password"])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: members_index.php");
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                } 
            }
            ?>
            <form action="members_login.php" method="post">
                <div class="form-group">
                    <input type="id" placeholder="Enter ID:" name="id" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                </div>
                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn btn-light">
                </div>
            </form>
        
            <br>
            <div><p>Not registered yet? <a class="membtn" href="Member_Registration.php">Register Here</a></p></div>
            <div class="ad-btn"> <br><br>
            <a href="http://localhost/Design-Project/admin_login.php">
                <button class="btn">                
                    LogIn as Admin
                </button>
            </a> 
            </div>
        </div><br><br>
            
        
    </div>
</body>
</html>