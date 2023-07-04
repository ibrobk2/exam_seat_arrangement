<?php
include "connection.php";



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
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

    .header{
        text-align: center;
        font-family: sans-serif;
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
</head>
<body>
    <div class="header">
        <img src="../images/hukpoly_logo.webp" alt="">
        <h2>Department of Computer Science</h2>
        <h3>Hassan Usman Katsina Polytechnic, Katsina</h3>
    </div>
<div class="table-container">
      <h2 style="text-align:center;"><u>Assigned Seating Arrangements</u></h2>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Matric No.</th>
            <th>Hall</th>
            <th>Seat Number</th>
          </tr>
        </thead>
        <tbody>
          <!-- Add rows dynamically using JavaScript/PHP based on the assigned seating arrangements -->
      <?php
       $stmt = $conn->query("SELECT * FROM students");
       $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch the exam hall data from the database
       $stmt2 = $conn->query("SELECT * FROM exam_halls");
      $examHalls = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      
      // var_dump($examHalls);
    
   

    
      $conn = null;

     // Shuffle the students array to randomize the seating arrangements
     shuffle($students);
 echo "<tbody>";
    
    foreach ($students as $student) {
      // foreach ($examHalls as $hall){
        $rand_num = rand(0, count($examHalls)-1);
         
        echo "<tr>";
        echo "<td>{$student['name']}</td>";
        echo "<td>{$student['matric_no']}</td>";
        echo "<td>{$examHalls[$rand_num]['name']}</td>";
        echo "<td>{$student['student_id']}</td>";
        echo "</tr>";
      // } 
    }
  
  

      ?>

          <!-- End of Seating Algorithm -->
        </tbody>
      </table>
    </div>
</body>
</html>
