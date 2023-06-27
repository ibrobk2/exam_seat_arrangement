<?php
$filename = 'data.csv'; // Replace 'data.csv' with the actual filename or path to your CSV file

// Open the file for reading
$file = fopen($filename, 'r');

// Check if the file was opened successfully
if ($file !== false) {
    // Read the file into an array
    $rows = [];
    while (($row = fgetcsv($file)) !== false) {
        $rows[] = $row;
    }

    // Shuffle the array randomly
    shuffle($rows);

    // Display the shuffled values in a table
    echo '<table>';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';

    // Close the file
    fclose($file);
} else {
    echo 'Failed to open the file.';
}
?>
