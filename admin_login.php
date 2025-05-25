<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: admin_index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_format.css">
    <link rel="stylesheet" href="index.css">


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
            </div>
        </header>   
    </div>
    <br><br><br><br><br><br>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $username = $_POST["username"];
           $password = $_POST["password"];
            require_once "admin_database.php";
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $sql2 = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: admin_index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
      <form action="admin_login.php" method="post">
        <div class="form-group">
            <input type="username" placeholder="Enter Username:" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
      
      <br> <br>
     <!-- <div><p>Not registered yet <a href="admin_registration.php">Register Here</a></p></div> -->
    </div>
</body>
</html>