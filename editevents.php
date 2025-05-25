<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: members_login.php");
    }

    $dbHost = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "event_register";

    $conn = new mysqli($dbHost, $user, $pass, $dbname);
    $m='';

    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $sql= "SELECT * from create_events WHERE id='$id' limit 1";
        $res= mysqli_fetch_assoc($conn->query($sql));


    }elseif(isset($_POST['id'])){
        $id =$_POST['id'];
        $eventID = $_POST['event-ID'];
        $title = $_POST['title'];
        $date = $_POST['date'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $img = $_FILES['image']['name'];

        if(isset($_POST['Submit'])){
            if (move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $img)) {
                // File moved successfully, continue with the database update
                $sql = "UPDATE create_events SET event_ID = '$eventID', title = '$title', description = '$description', date = '$date', location = '$location', image = '$img' WHERE id = '$id'";
                $result = $conn->query($sql);
                if($conn->query($sql)===true){

                    header('Location: users.php');
                } else{
                    $m = "Error updating record: " . $conn->error;
                    header("Location: editevents.php?id=$id");
                }
            } else {
                $m = "File upload failed.";
                header("Location: editevents.php?id=$id");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="members.css">
    <link rel="stylesheet" href="index.css">

    <title>Event Registration</title>
</head>
<body>
<header class="head">
    <div class="logo">
        <a href="http:">
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
    <div class="hero">
        <h1 class="title"><b>Edit Event <?php echo $id; ?></b></h1><br><br>
        <br><br>
    </div>
    <form action="editevents.php" method="POST" >
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="event-ID">Event ID:</label>
                <input type="text" class="form-control" name="event-ID" id="event-ID" placeholder="Event_ID" value="<?php echo $res['event_ID']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo $res['title']; ?>" placeholder="Title">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" id="date" value="<?php echo $res['date']; ?>" placeholder="date">
            </div>
            <div class="form-group col-md-6">
                <label for="location">Location:</label>
                <input type="text" class="form-control" name="location" id="location" value="<?php echo $res['location']; ?>" placeholder="Location">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" cols="30" rows="2" id="description" placeholder="Description"><?php echo $res['description']; ?></textarea>

            </div>
            <div class="form-group col-md-6">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-light" value="Submit" name="Submit">
        </div>
    </form>

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
                <a data-scroll="" href="http://localhost/Design-Project/vision.html">
                    <p class="info-link">Vision</p>
                </a>
            </div>
            <div class="info">
                <h3>UCPC events</h3><br>
                <a data-scroll="" href="http://localhost/Design-Project/events.html">
                    <p class="info-link">Programming Contest</p>
                </a>
                <a data-scroll="" href="http://localhost/Design-Project/events.html">
                    <p class="info-link">Industry Visit</p>
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
</body>
</html>
