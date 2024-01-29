<?php
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "universityofsam";

//create Connection
$conn = mysqli_connect("$servername", "$username", "$password", "$mydb");

//Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
