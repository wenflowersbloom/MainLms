<?php
include 'inc/connection.php';

// Retrieve the JSON data from the POST request
$datesData = $_POST["datesData"];

// Decode the JSON data into a PHP array
$datesArray = json_decode($datesData);

if ($datesArray !== null) {
    // Sanitize and prepare the array for the SQL query
    $escapedDates = array_map(function ($date) use ($link) {
        return $link->real_escape_string($date);
    }, $datesArray);

    // Construct the SQL query with the WHERE clause
    $filteredDatesString = "'" . implode("','", $escapedDates) . "'";
    $sql = "SELECT * FROM tbl_attendance WHERE DATE(timein) IN ($filteredDatesString)";

    // Execute the SQL query
    $result = $link->query($sql);

    if ($result) {
        $newAttendanceArray = array();

        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $newAttendanceArray[] = array_values($row); // Convert associative array to indexed array
        }

        $newAttendanceJson = json_encode($newAttendanceArray);
        echo json_encode($newAttendanceArray);
    } else {
        echo "No records found";
    }
} else {
    echo "Invalid JSON data received from JavaScript.";
}