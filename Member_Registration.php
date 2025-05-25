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
    <title>Student's Registration Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="members.css">
    <link rel="stylesheet" href="_style_.css">
    <link rel="stylesheet" href="form_format.css">

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
        <div class="hero">
            <h1 class="title"><b>Member Registration Form</b></h1><br><br>
        </div>
        <div class="container">
            <?php
            if (isset($_POST["submit"])) {
            $Full_name = $_POST["fullname"];
            $Student_ID = $_POST["id"];
            $Email = $_POST["email"];
            $Contact = $_POST["contact"];
            $Password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            
            $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

            $errors = array();
            
            if (empty($Full_name) OR empty($Student_ID) OR empty($Email) OR empty($Contact) OR empty($Password) OR empty($passwordRepeat)) {
                array_push($errors,"All fields are required");
            }
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($Password)<4) {
                array_push($errors,"Password must be at least 4 charactes long");
            }
            if ($Password!==$passwordRepeat) {
                array_push($errors,"Password does not match");
            }
            require_once "members_database.php";
            $sql = "SELECT * FROM members WHERE Email = '$Email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors,"Email already exists!");
            }
            if (count($errors)>0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                
                $sql = "INSERT INTO members (Full_name, Student_ID, Email, Contact, Password) VALUES ( ?, ?, ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sssss",$Full_name, $Student_ID, $Email, $Contact, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                }else{
                    die("Something went wrong");
                }
            }
            

            }
            ?>
            <form action="Member_Registration.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
                </div>
                <div class="form-group">
                    <input type="ID" class="form-control" name="id" placeholder="Student_ID:">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email:">
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" name="contact" placeholder="Contact:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-light" value="Submit" name="submit">
                </div>
            </form>
            <br>
            <div>
            <div><p>Already Registered? <a class="membtn" href="members_login.php">Login Here</a></p></div>
        </div>
        </div>

        <footer class="foot">
            <h1 class="title">Follow Us</h1>
            <div class="social-btns">
                <div class="col"><a class="btn" href="https://www.facebook.com/ulab.cpc" target="_blank"><img src="fblogo.png"></a></div>
    
                <div class="col"><a class="btn" href="https://www.linkedin.com/company/ulab-computer-programming-club/mycompany/" target="_blank"><img src="https://static.vecteezy.com/system/resources/previews/018/930/584/original/linkedin-logo-linkedin-icon-transparent-free-png.png"></a></div>
            </div>
            <p>Made with ❤️ by <b>Bushra, Razaan, Apon</b></p>
    
            <div class="information">
                <div class="info">
                    <h3>About UCPC</h3><br>
                    <a data-scroll="" href="http://localhost/Design-Project/index.html#aboutUs">
                        <p class="info-link">About</p>
                    </a>
                    <a data-scroll="" href="http://localhost/Design-Project/mvo.html">
                        <p class="info-link">Vision</p>
                    </a>
                </div>
                <div class="info">
                    <h3>UCPC events</h3><br>
                    <a data-scroll="" href="http://localhost/Design-Project/events.php">
                        <p class="info-link">Recent Events</p>
                    </a>
                    <a data-scroll="" href="http://localhost/Design-Project/up-events.php">
                        <p class="info-link">Upcoming Event</p>
                    </a>
                </div>
                <div class="info">
                    <h3>Resources</h3><br>
                    <a data-scroll="" href="http://localhost/Design-Project/index.html#faq">
                        <p class="info-link">FAQ</p>
                    </a>
                    <a data-scroll="" href="https://www.ulab.edu.bd/sites/default/files/ULAB-Code-of-Conduct-2015-Summer1.pdf">
                        <p class="info-link">Code of conduct</p>
                    </a>
                </div>
            </div>
    
            <div class="copyright">
                <p >Copyright © <script>document.write(new Date().getFullYear())</script> ULAB Computer Programming Club. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>