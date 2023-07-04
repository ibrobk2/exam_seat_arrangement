<?php


// $conn = mysqli_connect("localhost", "root", "", "evas") or die("failed to connect")
// Database connection settings
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "seatingarrangement";
  
  // Create a new PDO instance
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>