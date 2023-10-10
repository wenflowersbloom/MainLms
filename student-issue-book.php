<?php
include 'inc/header.php';
include 'inc/connection.php';
$rdate = date("d/m/Y", strtotime("+7 days"));
$no = '';
$std_no = ''; // Initialize $std_no
$dept = '';   // Initialize $dept
$email = '';  // Initialize $email
$utype = '';
?>

<head>
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Style for the custom select container */
        .custom-select-container {
            position: relative;
            display: block;
            /* This is changed from inline-block to block */
            width: 100%;
            /* This ensures it spans the full width of its container */
        }

        /* Style for the search input */
        .custom-select-input {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        }

        /* Style for the dropdown */
        .custom-select-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            display: none;
        }

        .custom-select-input:focus {
            border-color: #66afe9;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        }


        /* Style for each option */
        z .custom-select-option {
            padding: 10px;
            cursor: pointer;
        }

        .custom-select-option:hover {
            background-color: #f0f0f0;
        }

        /* The Modal */
        .modal {
            display: block;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 105%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            height: 90%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        /* Issue Book button*/
        .svt {
            float: right;
            background-color: green;

        }

        .svt:hover {
            float: right;
            background-color: darkgreen;

        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .title2 {
            float: left;
            margin-left: -190px;
            padding: 30px;
            font-weight: bolder;
            font-size: 30px;
        }

        .dashboard-content {
            background-image: url(inc/img/newbg.png);
            height: 91.8vh;
            background-size: cover;
            margin-top: 60px;
    		z-index: 1;
        }
    </style>
</head>

<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <center>
                <div class="col-md-6">
                    <div class="left">

                        <h2 style="padding: 0 0 0; margin: 0 0 0;font-weight:bold;color:white;">STUDENT ISSUE BOOK</h2>
                    </div>
                </div>

            </center>
            <div class="issueBook">
                <div class="row">
                    <div class="col-md-6">
                        <div class="issue-wrapper">
                            <video id="preview" width="590px"></video>
                            <form action="" class="form-control" method="post" id="contentContainer" name="reg">
                                <table class="table">
                                    <tr>
                                        <td class="">
                                            <!-- Move this input inside the form -->
                                            <input type="hidden" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                                <?php
                                if (isset($_POST["text"])) {

                                    $text = $_POST['text'];

                                    $sql = "SELECT std_no FROM tbl_student WHERE std_encrypt='$text'";

                                    $result = $link->query($sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $no = htmlspecialchars($row['std_no']);
                                        }
                                    } else {
                                        echo "0 results";
                                    }

                                    $sql = "SELECT std_no, std_name, std_college, std_email, utype FROM tbl_student WHERE std_encrypt='$text'";
                                    $result = $link->query($sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $std_no = htmlspecialchars($row['std_no']);
                                            $name = htmlspecialchars($row['std_name']);
                                            $dept = htmlspecialchars($row['std_college']);
                                            $email = htmlspecialchars($row['std_email']);
                                            $utype = htmlspecialchars($row['utype']);
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                ?>
                                    <script type="text/javascript">
                                        document.getElementById('preview').style.display = 'none';
                                    </script>
                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                        <!-- Modal Content -->
                                        <div class="modal-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>
                                                                <p>USER TYPE</p>
                                                                <input type="text" class="form-control" name="utype" value="<?php echo $utype; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>ID NUMBER</p>
                                                                <input type="text" class="form-control" name="std_no" value="<?php echo $std_no; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>NAME</p>
                                                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" readonly>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>COLLEGE</p>
                                                                <input type="text" class="form-control" name="dept" value="<?php echo $dept; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>
                                                                <p>EMAIL ADDRESS</p>
                                                                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="custom-select-container">
                                                                    <input type="text" class="custom-select-input" name="booksname" id="bookSearch" placeholder="Search for a book">
                                                                    <div class="custom-select-dropdown" id="bookSelect">
                                                                        <?php
                                                                        // Create a new SQL query to retrieve available books
                                                                        $availableBooksQuery = "SELECT books_name FROM add_book WHERE books_availability > 0";

                                                                        // Execute the query
                                                                        $res = mysqli_query($link, $availableBooksQuery);

                                                                        while ($row = mysqli_fetch_array($res)) {
                                                                            echo "<div class='custom-select-option'>";
                                                                            echo $row["books_name"];
                                                                            echo "</div>";
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>BORROWING DATE</p>
                                                                <input type="date" class="form-control" name="booksissuedate" value="<?php echo date("d/m/Y"); ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>RETURNING DATE</p>
                                                                <input type="date" class="form-control" name="booksreturndate" value="<?php echo $rdate; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="modal-footer">
                                                        <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
                                                        <input type="submit" id="submit2" name="submit2" class="svt btn btn-info" value="Issue Book">
                                                    </div>


                                                </div>
                                            </div>
                                        <?php
                                    }

                                        ?>
                            </form>
                            <?php
                            if (isset($_POST["submit2"])) {
                                $qty = 0;
                                $res = mysqli_query($link, "select * from add_book where books_name='$_POST[booksname]' ");
                                while ($row = mysqli_fetch_array($res)) {
                                    $qty = $row["books_availability"];
                                }
                                if ($qty == 0) {
                            ?>
                            
                                    <script type="text/javascript">
                                        document.getElementById('myModal').style.display = 'none';
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Failed',
                                            text: 'This book is not available',
                                            confirmButtonColor: '#008000',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Close the modal

                                                // Reload the page when OK button is clicked
                                                window.location.href = 'student-issue-book.php';
                                            }
                                        });
                                    </script>
                                    
                                    <?php
                                } else {
                                    $insertQuery = "INSERT INTO issue_book (id, utype, regno, name, dept, email, booksname, booksissuedate, booksreturndate) VALUES ('', '" . $_POST['utype'] . "', '" . $_POST['std_no'] . "', '" . $_POST['name'] . "', '" . $_POST['dept'] . "', '" . $_POST['email'] . "', '" . $_POST['booksname'] . "', '" . $_POST['booksissuedate'] . "', '" . $_POST['booksreturndate'] . "')";

                                    if (mysqli_query($link, $insertQuery)) {
                                        mysqli_query($link, "UPDATE add_book SET books_availability = books_availability - 1 WHERE books_name = '" . $_POST['booksname'] . "'");
                                    
                                    require 'phpmailer/PHPMailerAutoload.php';

                                    // ... (your existing code)

                                    if (mysqli_query($link, $insertQuery)) {
                                        mysqli_query($link, "UPDATE add_book SET books_availability = books_availability - 1 WHERE books_name = '" . $_POST['booksname'] . "'");

                                        // Send an email notification
                                        $to = $_POST['email'];
                                        $subject = 'Book Issuance Notification';
                                        $message = 'Dear ' . $_POST['name'] . ',<br><br>';
                                        $message .= 'You have successfully issued the book "' . $_POST['booksname'] . '".<br>';
                                        $message .= 'Please remember to return the book by ' . $_POST['booksreturndate'] . '.<br>';
                                        $message .= 'Thank you for using our library!<br><br>';
                                        $message .= 'Sincerely,';
                                        $message .= '<br>Your Library Team';

                                        // Create a PHPMailer instance
                                        $mail = new PHPMailer;

                                        // Enable SMTP debugging (optional)
                                        $mail->SMTPDebug = 0;

                                        // Set the PHPMailer to use SMTP
                                        $mail->isSMTP();

                                        // Specify the SMTP server
                                        $mail->Host = 'smtp.gmail.com';

                                        // Enable SMTP authentication
                                        $mail->SMTPAuth = true;

                                        // Your Gmail username (email address)
                                        $mail->Username = 'udmlibrary76@gmail.com';

                                        // Your Gmail password (application-specific password)
                                        $mail->Password = 'mngt tlkm pqxr vlfm';

                                        // Set the SMTP port (465 for SSL or 587 for TLS)
                                        $mail->Port = 587;

                                        // Set the encryption mechanism to use (TLS or SSL)
                                        $mail->SMTPSecure = 'tls';

                                        // Set the sender's email address and name
                                        $mail->setFrom('udmlibrary@gmail.com', 'UDM Library');

                                        // Set the recipient's email address
                                        $mail->addAddress($to);

                                        // Set email subject and content
                                        $mail->Subject = $subject;
                                        $mail->msgHTML($message);

                                        // Send the email
                                        if ($mail->send()) {
                                            ?>
                                            <script type="text/javascript">
                                                document.getElementById('myModal').style.display = 'none';
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success',
                                                    text: 'Books issued successfully. An email notification has been sent to the student.',
                                                    confirmButtonColor: '#008000',
                                                    confirmButtonText: 'OK'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Reload the page when OK button is clicked
                                                        window.location.href = 'student-issue-book.php';
                                                    }
                                                });
                                            </script>
                                            <?php
                                        } else {
                                            // Handle email sending errors
                                            echo "Mailer Error: " . $mail->ErrorInfo;
                                        }
                                    } else {
                                        // Handle the case where the insert query fails
                                        echo "Error: " . mysqli_error($link);
                                    }
                                    ?>
                                    
                                    <?php
                                    } else {
                                        // Handle the case where the insert query fails
                                        echo "Error: " . mysqli_error($link);
                                    }
                                    ?>
                            <?php
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var input = document.getElementById("bookSearch");
        var select = document.getElementById("bookSelect");
        var options = select.getElementsByClassName("custom-select-option");
        input.addEventListener("input", function() {
            var filter = input.value.toUpperCase();

            for (var i = 0; i < options.length; i++) {
                var option = options[i];
                var txtValue = option.textContent || option.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }

            // Show or hide the dropdown based on the filter
            select.style.display = filter.length > 0 ? "block" : "none";
        });

        // Handle option selection
        for (var i = 0; i < options.length; i++) {
            var option = options[i];
            option.addEventListener("click", function() {
                input.value = this.textContent;
                select.style.display = "none";
            });
        }

        // Hide the dropdown when clicking outside of it
        window.addEventListener("click", function(e) {
            if (e.target != select && e.target != input) {
                select.style.display = "none";
            }
        });
        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('myModal').style.display = 'none';
        });
    });


    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('No cameras found');
        }

    }).catch(function(e) {
        console.error(e);
    });

    scanner.addListener('scan', function(c) {
        document.getElementById('text').value = c;
        document.forms["reg"].submit();
    });
</script>