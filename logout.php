<?php
session_start();
session_unset();
session_destroy();
die("<script>alert('Successfully Logged Out.');window.location.href='adminlogin.php';</script>");
?>