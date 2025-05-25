<?php

    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: members_login.php");
    }

    // Establish a database connection (replace these values with your actual database credentials)
    $dbHost = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "event_register";

    $conn = new mysqli($dbHost, $user, $pass, $dbname);

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get form input values
        $eventID = $_POST['event-ID'];
        $title = $_POST['title'];
        $date = $_POST['date'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $img = $_FILES['image'];
        $iName = $img['name'];
        $tempName = $img['tmp_name'];

        // Prepare and execute the SQL query
        $format = explode('.', $iName);
        $actualName = strtolower($format[0]);
        $actualFormat = strtolower($format[1]);
        $allowedFormats = ['jpg', 'png', 'jpeg', 'gif'];

        if (in_array($actualFormat, $allowedFormats)) {
            $file = 'Uploads/' . $actualName . '.' . $actualFormat;
            $sql = "INSERT INTO create_events(event_ID, title, description, date, location, image) VALUES ('$eventID', '$title', '$description', '$date', '$location', '$file')";
            if ($conn->query($sql) === true) {
                move_uploaded_file($tempName, $file);
                echo "<div class='alert alert-success'>Data inserted successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid file format</div>";
        }
    }

    // Close the database connection
    $conn->close();
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
    <link rel="stylesheet" href="recentev.css">
    

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
            <a class="nav-link nav-link-grow-up" href="users.php">General Members</a>    
            <a class="nav-link nav-link-grow-up" href="rec_event_mngmnt.php">Recent Events</a>                                                                     
            <a class="nav-link nav-link-grow-up" href="up_event_mngmnt.php">Upcoming Events</a>    
            <a class="nav-link nav-link-grow-up" href="event_reg_list.php">Event Reg. List</a>                                                                     
            <a class="nav-link nav-link-grow-up" href="admin_logout.php">Logout</a>                                                                     

        </div>
    </header><br><br>
    <form class="recent" action="createevents.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="event-ID">Event ID:</label>
                <input type="text" class="form-control" name="event-ID" id="event-ID" placeholder="Event_ID">
            </div>
            <div class="form-group col-md-6">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date:</label>
                <input type="text" class="form-control" name="date" id="date" placeholder="date">
            </div>
            <div class="form-group col-md-6">
                <label for="location">Location:</label>
                <input type="location" class="form-control" name="location" id="location" placeholder="Loaction">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="description">Description:</label>
                <textarea class="from-control" name="description" cols="30" rows="2" id="description" placeholder="Description"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-light" value="Upload" name="submit">
        </div>
    </form>
    
</body> 
</html>