<?php
include 'inc/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ft_id = mysqli_real_escape_string($link, $_POST['ft_id']);
    $ft_name = mysqli_real_escape_string($link, $_POST['ft_name']);
    $ft_email = mysqli_real_escape_string($link, $_POST['ft_email']);
    $ft_college = mysqli_real_escape_string($link, $_POST['ft_college']);
    $ft_contact = mysqli_real_escape_string($link, $_POST['ft_contact']);

    // Update the faculty information in the database
    $query = "UPDATE tbl_faculty SET ft_name='$ft_name', ft_email='$ft_email', ft_college='$ft_college', ft_contact='$ft_contact' WHERE ft_id='$ft_id'";
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