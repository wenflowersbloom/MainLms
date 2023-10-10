<?php
include 'inc/connection.php';

// Include the PHPMailer library for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoloader


// Function to send a reminder email
function sendReminderEmail($email, $bookTitle, $reminderDate) {
    $mail = new PHPMailer(true);

    try {
        // SMTP settings for your email service provider
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'udmlibrary76@gmail.com';
        $mail->Password = 'udmlibrary1012';
        $mail->SMTPSecure = 'tls'; // or 'ssl'
        $mail->Port = 587; // or 465

        // Sender and recipient
        $mail->setFrom('udmlibrary76@gmail.com', 'Library System');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(false);
        $mail->Subject = 'Library Book Return Reminder';
        $mail->Body = "Please return the book \"$bookTitle\" by $reminderDate.";

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Handle POST request to add borrowed book information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $email = $data['email'];
    $bookTitle = $data['booksname'];
    $booksissuedate = $data['booksissuedate'];
    $booksreturndate = $data['booksreturndate'];

    // Database connection settings
    $servername = 'localhost:3307';
    $username = 'root';
    $password = '';
    $dbname = 'capstone1db';

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Insert book borrowing information into the database
    $sql = "INSERT INTO borrowed_books (email, book_title, borrowed_date, reminder_date) VALUES ('$email', '$bookTitle', '$booksissuedate', '$booksreturndate')";

    if ($conn->query($sql) === TRUE) {
        // Send a reminder email
        if (sendReminderEmail($email, $booksname, $booksreturndate)) {
            echo 'Reminder email sent successfully';
        } else {
            echo 'Error sending email';
        }
    } else {
        echo 'Error adding borrowing information to the database: ' . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>