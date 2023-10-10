<?php
include 'inc/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stdNo = mysqli_real_escape_string($link, $_POST['std_no']);
    $stdName = mysqli_real_escape_string($link, $_POST['std_name']);
    $stdCourse = mysqli_real_escape_string($link, $_POST['std_college']);
    $stdEmail = mysqli_real_escape_string($link, $_POST['std_email']);

    // Update the student information in the database
    $query = "UPDATE tbl_student SET std_name='$stdName', std_college='$stdCourse', std_email='$stdEmail' WHERE std_no='$stdNo'";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo 'success';
    } else {
        echo "Error: " . mysqli_error($link);  // This will give a detailed error message
    }
} else {
    echo 'Invalid request';
}
?>
