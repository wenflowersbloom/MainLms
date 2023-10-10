<?php
include 'inc/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <link rel="stylesheet" href="./inc/css/pro1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/75e838629a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    
    <style>
        * {
            font-family: "Century Gothic",
                CenturyGothic, AppleGothic, sans-serif;
        }

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin-bottom: 0px;
            margin-top: 5px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        body {
            background: #76b852;
            /* fallback for old browsers */
            background: rgb(141, 194, 111);
            background: linear-gradient(90deg, rgba(141, 194, 111, 1) 0%, rgba(118, 184, 82, 1) 50%);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            width: 100%;
            height: 100vh;
            background-image: url(udmbg.png);
            background-position: center;
            background-size: cover;
            position: relative;
        }


        nav {
            margin-left: 0px;
            width: 500%;
            height: 80px;
            background-color: #0b6b09;
            line-height: 80px;
        }


        nav ul {
            float: right;
            margin: 0;
            margin-right: 1.9rem;
        }

        nav ul li {
            list-style-type: none;
            display: inline-block;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 20px;
            font-size: 1.2rem;
        }

        img {
            width: 14%;
            margin-left: 1.9rem;
            margin-top: -4%;
        }

        .logo1 {
            width: 23%;
            margin-left: 1.9rem;
            margin-top: 1%;

        }

        .logo2 {
            width: 3.5%;
            position: absolute;
            margin-left: 45rem;
            margin-top: 1%;

        }

        /* END OF CODEPEN CSS */

        .login {
            background-image: url(inc/img/bglogin4.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            padding: 50px;
            padding-bottom: 30px;
        }

        .reg-header h2 {
            color: #065c09;
            z-index: 999999;
        }

        .login-body h4 {
            margin-bottom: 20px;
            color: #065c09;
        }

        .login-body input[type=text],
        .login-body input[type=password] {
            border: 1px solid #065c09;
        }

        .login-body .submit {
            background: #065c09;
            border: none;
        }

        .logo {
            width: 200px;
            height: 200px;

        }

        .input-field {
            background: #eaeaea;
            margin: 15px 0;
            border-radius: 3px;
            display: flex;
            align-items: center;
        }

        input {
            width: 100%;
            background-color: transparent;
            border: 0;
            outline: 0;
            padding: 18px 15px;
        }

        .input-field i {
            margin-left: 15px;
            color: #999;
        }

        .go-back-button {
            background-color: white;
            color: darkgreen;
            font-weight: bold;
            padding: 7px;
            font-size: 14px;
            border: 2px solid green;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s ease;
        }

        .go-back-button:hover {
            background-color: #43A047;
            color: white;
        }



        /* JOMAR CSS */

        /* .registration{
            background-image: url(inc/img/3.jpg);
            margin-bottom: 30px;
            padding: 50px;
            padding-bottom: 70px;
        }
        .reg-header h2{
            color: #DDDDDD;
            z-index: 999999;
        }
        .login-body h4{
            margin-bottom: 20px;
        } */
    </style>
</head>

<body>
    <div class="login registration">
        <div class="wrapper">

            <div class="reg-header text-center">
                <!-- <h2>Universidad De Manila</h2> -->
                <div class="gap-30"></div>
                <div class="gap-30"></div>
            </div>


            <div class="login-page">
                <button class="go-back-button" onclick="goBack()"><i class="fa-solid fa-chevron-left"></i>    Go Back</button>

                <div class="form">
                    <h4 style="color: green; font-weight:bold; ">Library Login Form</h4>
                    <form class="login-form" action="" method="post">
                        <input type="text" id="last_name_input" name="last_name" class="form-control" placeholder="Last Name" required />
                        <input type="text" id="first_name_input" name="first_name" class="form-control" placeholder="First Name" required />
                        <input type="text" name="username" class="form-control" placeholder="Username" required />
                        <input type="password" name="password" class="form-control" placeholder="Password" required />
                        <div id="password-message" style="color: red;"></div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required />
                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required />
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" required />
                        <select class="form-control" id="user_role" name="user_role" style="margin-bottom: 10px;">
                            <option value="none">Role</option>
                            <option value="STAFF">STAFF</option>
                            <option value="ADMIN">ADMIN</option>
                        </select>
                        <button class="btn change" value="Register" name="submit">Register</button>
                        <p class="message">Already registered? <a href="login.php">Sign In</a></p>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST["submit"])) {
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $name = $last_name . ', ' . $first_name;
                $photo = "upload/avatar.jpg";
                mysqli_query($link, "insert into lib_registration values('','$name','$_POST[username]','$_POST[password]','$_POST[email]','$_POST[phone]','$_POST[address]','$photo','', '$_POST[user_role]')");
                // Display SweetAlert and redirect
                echo "<script>
            Swal.fire({
                title: 'User Registration Successful!',
                text: 'Do you want to be redirected to the login page?',
                icon: 'success',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#008000',
                cancelButtonColor: '#808080',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = 'login.php'; // Redirect to the login page
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = 'registration.php'; // Redirect to the login page
                }
            });
        </script>";
            }
            ?>
        </div>
    </div>
    <div class="footer text-center">
        <p>&copy; All rights reserved IT-41 GROUP1</p>
    </div>

    <!-- LN + FN -->
    <script>
        const lastNameInput = document.getElementById("last_name_input");
        const firstNameInput = document.getElementById("first_name_input");

        lastNameInput.addEventListener("input", function() {
            this.value = capitalizeFirstLetter(this.value);
        });

        firstNameInput.addEventListener("input", function() {
            this.value = capitalizeFirstLetter(this.value);
        });

        function capitalizeFirstLetter(text) {
            return text.charAt(0).toUpperCase() + text.slice(1);
        }
    </script>

    <!-- Password MEssage -->
    <script>
        const passwordInput = document.getElementById("password");
        const passwordMessage = document.getElementById("password-message");

        passwordInput.addEventListener("input", function() {
            const password = this.value;

            if (password.length < 8) {
                passwordMessage.textContent = "Password must be at least 8 characters long";
            } else if (!/^(?=.*[0-9])(?=.*[a-zA-Z])/.test(password)) {
                passwordMessage.textContent = "Password must contain both letters and numbers";
            } else {
                passwordMessage.textContent = ""; // Clear the message if the requirements are met
            }
        });
    </script>
    <!-- Go back button script -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>



    <script src="inc/js/jquery-2.2.4.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/custom.js"></script>
</body>

</html>
