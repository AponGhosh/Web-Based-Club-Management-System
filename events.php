<?php
    // Establish a database connection (replace these values with your actual database credentials)
    $dbHost = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "event_register";

    $conn = new mysqli($dbHost, $user, $pass, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM recent_events";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="event.css">
    <title>ULAB Computer Programming Club</title>
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
            </div>
        </header>   
    </div> 

    <div class="body">
        <div class="hero">
            <h1 class="title">Our Events</h1>
            <p class="myPara">
                
                At UCPC, we organize various and high-quality TECH events, through which we aim to best fit our community needs and to provide a skillful and complete acquirement of knowledge for all the technology enthusiasts!
            </p>
            <a href="http://localhost/Design-Project/up-events.php">
                <button class="btn">                
                    Upcoming Events
                </button>
            </a>
        </div>

        <?php
        // Loop through the fetched data and display events
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="event-name">
            <h1><?php echo $row['title']; ?></h1><br>
            </div>
            <div class="events">
                <div class="images">
                    <div class="events1-1" style="background-image: url('<?php echo $row['imageone']; ?>');"></div>
                    <div class="events1-2" style="background-image: url('<?php echo $row['imagetwo']; ?>');"></div>
                </div>
                <div class="event-details">
                    <h4>Event ID: <?php echo $row['event_ID']; ?></h4><br>
                    <h4>Event Date:<?php echo $row['date']; ?></h4><br>
                    <h4>Event Venue:<?php echo $row['venue']; ?></h4><br>
                    <p class="Para"><?php echo $row['description']; ?></p>
                </div>
            </div>

            <?php
        }

        // Close the result set and database connection
        $result->free_result();
        $conn->close();
        ?>

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