<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "member_login_register";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

return $conn;

?>