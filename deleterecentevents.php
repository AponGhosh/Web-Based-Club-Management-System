<?php
    $dbHost = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "event_register";

    $conn = new mysqli($dbHost, $user, $pass, $dbname);

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Perform the delete operation
        $deleteQuery = "DELETE FROM recent_events WHERE id = $id";
        $result = $conn->query($deleteQuery);

        if ($result) {
            // Record deleted successfully, set confirmation message
            session_start();
            if (!isset($_SESSION["user"])) {
                header("Location: members_login.php");
            }
            $_SESSION['confirmation_message'] = "Record deleted successfully!";

            // Redirect to users.php
            header("Location: users.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Invalid or missing record ID";
    }

    // Close the database connection
    $conn->close();
?>
