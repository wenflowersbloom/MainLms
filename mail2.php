<?php
//    $res = mysqli_query($link, "select * from std_registration where id=$id");
//    while($row = mysqli_fetch_array($res)){
//        $email      = $row['email']; 
//    }
    
    require "phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
    //$mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'josemariedevera24@gmail.com';                 // SMTP username
    $mail->Password = 'ItsSecret';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('josemariedevera24@gmail.com', 'jose');
    $mail->addAddress('mrmamunlgd@gmail.com');     // Add a recipient
    $mail->addReplyTo('josemariedevera24@gmail.com');

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';


    if(!$mail->send()) {
        echo 'Message could not be sent.';

    } else {
        echo 'Message has been sent';
    }



?>
