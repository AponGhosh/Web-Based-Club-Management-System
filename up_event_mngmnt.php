<?php
    
    session_start();
    if (!isset($_SESSION["user"])) {
    header("Location: admin_login.php");
    }

    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "member_login_register");
    $cone = mysqli_connect("localhost", "root", "", "event_register");

    // Check connection
    if (!$cone) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (!$cone) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Select data from table
    $sql = "SELECT Full_name, Student_ID, Email, Contact FROM members";
    $sqly = "SELECT id, event_ID, title, description, date, location, image FROM create_events";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_query($cone, $sqly);

    // Close connection
    mysqli_close($conn);
    mysqli_close($cone);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="members.css">
    <link rel="stylesheet" href="index.css">

    <title>Event Registration</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .custom-delete-button {
            padding: 5px 10px; /* Adjust padding as needed */
            background-color: #dc3545; /* Bootstrap's danger color */
            color: #fff; /* White text color */
            border: none;
            border-radius: 3px; /* Add rounded corners */
            text-decoration: none;
        }

        .custom-edit-button {
            padding: 5px 10px; /* Adjust padding as needed */
            background-color: #007bff; /* Bootstrap's primary color */
            color: #fff; /* White text color */
            border: none;
            border-radius: 3px; /* Add rounded corners */
            text-decoration: none;
        }

    </style>

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
    </header> <br><br><br>
    <div class="hero">
            <h1 class="title"><b>Upcoming Events</b></h1><br><br>
        </div>
        <a href="http://localhost/Design-Project/createevents.php">
            <button style="border: 1px solid white;padding: 10px 5px;
            background:blue;color:white;border-radius:5px;margin-left:45%;margin-bottom:10px">Add Event</button>
        </a>
        <table>
            <thead>
            <tr>
                <th>Image</th>
                <th>Event ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $data->fetch_assoc()) {
                        echo "<tr>";
                        // Add image column
                        echo "<td><img src='" . $row["image"] . "'></td>";
                        echo "<td>" . $row["event_ID"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td><a href='deleteevent.php?id=" . $row['id'] . "' class='custom-delete-button'>Delete</a></td>";
                        echo "<td><a href='editevents.php?id=" . $row['id'] . "' class='custom-edit-button'>Edit</a></td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
            ?>


            </tbody>
        </table>
  


    </body>
</html>