<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>
<body>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the form data
  $hallName = $_POST["hall_name"];
  $seatingCapacity = $_POST["capacity"];
  
  // Perform validation on the form data
  if (empty($hallName) || empty($seatingCapacity)) {
    die("Error: Please fill in all fields.");
  }
  
  // Ensure seating capacity is a positive integer
  if (!ctype_digit($seatingCapacity) || $seatingCapacity <= 0) {
    die("Error: Seating capacity must be a positive integer.");
  }
  
  // TODO: Save the hall to the database
  // Modify the following code to match your database configuration and table structure
  
  // Database connection settings
//   $servername = "your_servername";
//   $username = "your_username";
//   $password = "your_password";
//   $dbname = "your_database";
  
  // Create a new PDO instance
//   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    include_once "connection.php";  

  // Prepare and execute the SQL statement to insert the new exam hall into the database
  $stmt = $conn->prepare("INSERT INTO exam_halls (name, seating_capacity) VALUES (:hall_name, :seating_capacity)");
  $stmt->bindParam(":hall_name", $hallName);
  $stmt->bindParam(":seating_capacity", $seatingCapacity);
  $stmt->execute();
  
  // Redirect back to index.php after successful registration
  // header("Location: index.php");
  echo "<script>
  Swal.fire(
    'Good job!',
    'Hall Registered Successful!',
    'success'
  )
  }
  
  </script>";
  exit();
} else {
  die("Error: Invalid request.");
}
?>
</body>