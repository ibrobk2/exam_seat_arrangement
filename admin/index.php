<?php
include "connection.php";
require('fpdf/fpdf.php');
// Variable to track the reset status
$resetStatus = false;

// Variable to track the registration status
$registrationStatus = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    // Create a new PDO instance
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Perform the necessary reset operations
    // Delete all data from the necessary tables or perform any other required actions
    
    // Example: Resetting the students and exam_halls tables
    $conn->exec("TRUNCATE TABLE students");
    $conn->exec("TRUNCATE TABLE exam_halls");
    
    // Set the reset status to true
    $resetStatus = true;
  } catch (PDOException $e) {
    die("Error: " . $e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Exam Venue Allocation and Seat Arrangements System</title>
  <!-- Sweet Alert -->
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
  <style>
    /* Add your CSS styles here */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 960px;
      margin: 0 auto;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
      margin-top: 0;
    }
    
    .form-container {
      background-color: #f4f4f4;
      padding: 20px;
      margin-bottom: 20px;
    }
    
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4caf50;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .button:hover {
      background-color: #45a049;
    }
    
    .table-container {
      overflow-x: auto;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .btn-primary, #hall_btn{
      padding: 10px;
      border: none;
      ouline: none;
      color: white;
      background-color: dodgerblue;
      border-radius: 6px;
    }

    .btn-primary:hover{
      cursor: pointer;
      opacity: 0.85;
    }

   
    
    @media screen and (max-width: 600px) {
      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }
      
      th, td {
        display: inline-block;
        width: auto;
      }
    }
  </style>
   <script>
    function confirmReset() {
      return confirm("Are you sure you want to reset the system? This action cannot be undone.");
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Exam Venue Allocation and Seat Arrangements System</h1>
    
   
    
    <div class="form-container">
      <h2>Register/Create Exam Hall</h2>
      <!-- Add form elements for registering or creating exam halls -->
      <?php if ($registrationStatus): ?>
    <p>The exam hall has been registered successfully.</p>
  <?php endif; ?>
  
  <form method="post" action="register_hall.php">
    <label for="hall_name">Hall Name:</label>
    <input type="text" name="hall_name" id="hall_name" required>
    <br>
    <br>
    <label for="capacity">Capacity:</label>
    <input type="number" name="capacity" id="capacity" required>
    <br>
    <br>
    <button type="submit" id="hall_btn">Register Hall</button>
  </form>
    
    </div>


    <!-- Upload data section -->
    <div class="form-container">
      <h2>Upload Students File</h2>
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv" required>
        <input type="submit" value="Upload" class="button">
      </form>
    </div>
    
    <!-- <div class="table-container">
      <h2>Assigned Seating Arrangements</h2>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Matric No.</th>
            <th>Hall</th>
            <th>Seat Number</th>
          </tr>
        </thead>
        <tbody> -->
          <!-- Add rows dynamically using JavaScript/PHP based on the assigned seating arrangements -->
      <?php
//        $stmt = $conn->query("SELECT * FROM students");
//        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         // Fetch the exam hall data from the database
//        $stmt2 = $conn->query("SELECT * FROM exam_halls");
//       $examHalls = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      
//       // var_dump($examHalls);
    
   

    
//       $conn = null;

//      // Shuffle the students array to randomize the seating arrangements
//      shuffle($students);
//  echo "<tbody>";
    
//     foreach ($students as $student) {
//       // foreach ($examHalls as $hall){
//         $rand_num = rand(0, count($examHalls)-1);
         
//         echo "<tr>";
//         echo "<td>{$student['name']}</td>";
//         echo "<td>{$student['matric_no']}</td>";
//         echo "<td>{$examHalls[$rand_num]['name']}</td>";
//         echo "<td>{$student['student_id']}</td>";
//         echo "</tr>";
    //   // } 
    // }
  
  

    //   ?>

          <!-- End of Seating Algorithm -->
        <!-- </tbody>
      </table>
    </div> -->
    
    <div class="table-container">
      <h2>Invigilators</h2>
      <table>
        <thead>
          <tr>
            <th>Invigilator ID</th>
            <th>Name</th>
            <th>Contact Information</th>
          </tr>
        </thead>
        <tbody>
          <!-- Add rows dynamically using JavaScript based on the assigned invigilators -->
        </tbody>
      </table>
    </div>
    
    <div class="form-container">
      <h2>Reset System</h2>
      <!-- Add form elements and JavaScript logic to reset the system -->
      <?php if ($resetStatus): ?>
    <p>The system has been reset successfully.</p>
  <?php endif; ?>
  
  <form method="post" onsubmit="return confirmReset()" action="reset.php">
    <button type="submit" style="padding: 10px; background-color: red;color: azure; border:none; border-radius: 5px; cursor:pointer;">Reset System</button>
  </form>
    </div>
    
    <div class="form-container">
      <h2>Generate Reports</h2>
      <!-- Add form elements and JavaScript logic to generate reports in PDF or Excel format -->
      <form action="arrangement.php">
        <button class="btn btn-primary">Generate Report</button>
        <button class="btn btn-primary" onclick="sweet()" type="button">Sweet Test</button>
      </form>
    </div>
  </div>
  
  <script>
    // Add your JavaScript code here
    // Use JavaScript to dynamically populate the tables with data
    // Implement any additional functionalities as required

    function sweet(){
      Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)
    }
  </script>
</body>
</html>
