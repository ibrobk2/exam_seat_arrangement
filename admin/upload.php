<?php
// Check if a file was uploaded
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
  $file = $_FILES["file"]["tmp_name"];
  
  // Check if the uploaded file is a CSV file
  $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
  if ($fileType !== "csv") {
    die("Error: Please upload a CSV file.");
  }
  
  // Process the CSV file
  $students = [];
  if (($handle = fopen($file, "r")) !== false) {
    // Read each line of the CSV file
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
      // Skip the header row
      if ($data[0] === "Student ID" && $data[1] === "NAME") {
        continue;
      }
      
      // Extract student ID and name
      $studentId = $data[0];
      $name = $data[1];
      $matric_no = $data[2];
      
      // Store the student in an array
      $students[] = [
        "student_id" => $studentId,
        "name" => $name,
        "matric_no" => $matric_no
      ];
    }
    
    fclose($handle);
    
    // TODO: Save the students to the database
    // Modify the following code to match your database configuration and table structure
    
    // Database connection settings
    // $servername = "your_servername";
    // $username = "your_username";
    // $password = "your_password";
    // $dbname = "your_database";
    
    // Create a new PDO instance
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    include_once "connection.php";

    // Prepare and execute the SQL statement to insert students into the database
    $stmt = $conn->prepare("INSERT INTO students (student_id, name, matric_no) VALUES (:student_id, :name, :matric_no)");
    foreach ($students as $student) {
      $stmt->bindParam(":student_id", $student["student_id"]);
      $stmt->bindParam(":name", $student["name"]);
      $stmt->bindParam(":matric_no", $student["matric_no"]);
      $stmt->execute();
    }
    
    // Redirect back to index.php after successful upload
    header("Location: index.php");
    exit();
  } else {
    die("Error: Failed to read the uploaded file.");
  }
} else {
  die("Error: No file was uploaded or an error occurred.");
}
?>
