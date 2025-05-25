<?php
session_start();
session_destroy();
header("Location: members_login.php");
?>