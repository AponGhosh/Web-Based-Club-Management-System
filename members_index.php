<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: members_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="members.css">
    <link rel="stylesheet" href="index.css">.
    <link rel="stylesheet" href="form_format.css">.

    <title>Event Registration</title>
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
                <a class="nav-link nav-link-grow-up" href="http://localhost/Design-Project/members_logout.php">Logout</a>  
            </div>
        </header> 
    </div> 
    
    <div class="body">
        <div class="hero">
            <h1 class="title"><b>Event Registration Form</b></h1><br><br>
        </div>  
        <div class="container">
            <?php
            if (isset($_POST["submit"])) {
                $Event_ID = $_POST["event-ID"];
                $Full_name = $_POST["fullname"];
                $Student_ID = $_POST["id"];
                $Email = $_POST["email"];
                $Contact = $_POST["contact"];

                $errors = array();
                
                if (empty($Event_ID) OR empty($Full_name) OR empty($Student_ID) OR empty($Email) OR empty($Contact)) {
                array_push($errors,"All fields are required");
                }
                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
                }

                require_once "event-reg-database.php";
                $sql = "SELECT * FROM events_reg_list WHERE Email = '$Email'";
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
                
                $sql = "INSERT INTO events_reg_list (Event_ID, Full_name, Student_ID, Email, Contact) VALUES ( ?, ?, ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sssss",$Event_ID, $Full_name, $Student_ID, $Email, $Contact);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are successfully registered for the event.</div>";
                }else{
                    die("Something went wrong");
                }
                }  
            }
            ?>
            <form action="members_index.php" method="post">
            <div class="form-group">
                    <input type="text" class="form-control" name="event-ID" placeholder="Event_ID:">
                </div>
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
                <div class="form-btn">
                    <input type="submit" class="btn btn-light" value="Submit" name="submit">
                </div>
            </div> 
            </form>
        </div>
    </div>
</body> 
</html>