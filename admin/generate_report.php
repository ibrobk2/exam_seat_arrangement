<?php
include_once "connection.php";
require_once 'fpdf/fpdf.php';
// require_once 'index.php';

// TODO: Retrieve the necessary data from the database or any other source
// Modify the following code to match your database configuration and data retrieval process

// Database connection settings
// $servername = "your_servername";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database";



try {
  // Create a new PDO instance
//   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Retrieve the data from the database
  $stmt = $conn->query("SELECT * FROM students");
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Retrieve the data from the database
  $stmt = $conn->query("SELECT * FROM exam_halls");
  $hall = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  // Generate the PDF report
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(190, 10, 'Student Report', 0, 1, 'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial', '', 12);
  
  foreach ($students as $student) {
    $pdf->Cell(50, 10, 'Name:', 1, 0);
    $pdf->Cell(140, 10, $student['name'], 1, 1);
    $pdf->Cell(50, 10, 'Matric No.:', 1, 0);
    $pdf->Cell(140, 10, $student['matric_no'], 1, 1);
    // $pdf->Cell(50, 10, 'Venue:', 1, 0);
    // $pdf->Cell(140, 10, $hall['name'], 1, 1);
    $pdf->Cell(50, 10, 'Seat No.:', 1, 0);
    $pdf->Cell(140, 10, $student['student_id'], 1, 1);
    $pdf->Ln(5);
  }
  
  // Output the PDF to the browser
  $pdf->Output('report.pdf', 'I');
} catch (PDOException $e) {
  die("Error: " . $e->getMessage());
}
?>
