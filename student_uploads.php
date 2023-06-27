<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Exam Schedule</title>
    <style>
    /* Responsive table */
    .responsive-table {
        width: 100%;
        overflow-x: auto;
    }

    /* Table styles */
    .responsive-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .responsive-table th,
    .responsive-table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Table colors */
    .responsive-table th {
        background-color: #f2f2f2;
    }

    .responsive-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .responsive-table tr:hover {
        background-color: #ddd;
    }

    /* Table responsiveness */
    @media only screen and (max-width: 768px) {
        .responsive-table table {
            width: 100%;
        }

        .responsive-table thead,
        .responsive-table tbody,
        .responsive-table th,
        .responsive-table td,
        .responsive-table tr {
            display: block;
        }

        .responsive-table th {
            text-align: center;
        }

        .responsive-table th,
        .responsive-table td {
            border: none;
            padding: 8px;
        }

        .responsive-table tr {
            margin-bottom: 15px;
        }

        .responsive-table td {
            border-bottom: 1px solid #ddd;
            text-align:center;

        }

        .responsive-table td:before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
    }
</style>

</head>
<body>
    
</body>
</html>
<?php
$filename = 'data.csv'; // Replace 'data.csv' with the actual filename or path to your CSV file

// Open the file for reading
$file = fopen($filename, 'r');

// Check if the file was opened successfully
if ($file !== false) {
    // Read the file line by line until the end
    while (($row = fgetcsv($file)) !== false) {
        // Display the values for each row
        echo '<div class="responsive-table">';
        echo '<table>';
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
        echo '</table>';
        echo '</div>';
    }

    // Close the file
    fclose($file);
} else {
    echo 'Failed to open the file.';
}
?>
