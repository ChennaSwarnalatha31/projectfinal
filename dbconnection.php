<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'feedback2023';
$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn){
    die("<script>alert('Database Error.');window.location.href='index.php';</script>");
}
?>