<?php
session_start();
include 'inc/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="./inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="./inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./inc/css/pro1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        h4 {
            font-family: "Century Gothic",
                CenturyGothic, AppleGothic, sans-serif;
        }

        * {
            font-family: "Century Gothic",
                CenturyGothic, AppleGothic, sans-serif;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin-bottom: 0px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Century Gothic",
                CenturyGothic, AppleGothic, sans-serif;
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
            font-family: "Roboto", sans-serif;
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
            margin-bottom: 30px;
            padding: 50px;
            padding-bottom: 70px;
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

        .alerto {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-dangero {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
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
            <!-- <div class="gap-10">
                <img class="logo img-fluid mb-2 mx-auto d-block" src="./inc/img/librarylogo.png" alt="logo">
            </div> -->

            <!-- END OF NAVBAR CONTAINER -->

            <div class="login-page">
                <div class="form">
                    <h4 style="color: green; font-weight:bold; ">Library Login Form</h4>

                    <?php
                    if (isset($_POST["login"])) {
                        $count = 0;
                        $res = mysqli_query($link, "select * from lib_registration where username='$_POST[username]' && password= '$_POST[password]' ");
                        $count = mysqli_num_rows($res);
                        if ($count == 0) {
                    ?>
                            <div class="alerto alert-dangero">
                                <strong>Error!</strong> Invalid credentials.
                            </div>
                        <?php
                        } else {
                            while ($row = mysqli_fetch_array($res)) {
                                $_SESSION["role"] = $row["role"];
                                $_SESSION["username"] = $_POST["username"];
                            }
                            
                        ?>
                            <script type="text/javascript">
                                window.location = "dashboard.php";
                            </script>
                    <?php
                        }
                    }
                    ?>


                    <form class="register-form">
                        <input type="text" placeholder="name" />
                        <input type="password" placeholder="password" />
                        <input type="text" placeholder="email address" />
                        <button>create</button>
                        <p class="message">Already registered? <a href="#">Sign In</a></p>
                    </form>
                    <form class="login-form" action="" method="post">
                        <input type="text" name="username" class="form-control" placeholder="Username" required />
                        <input type="password" name="password" class="form-control" placeholder="Password" required />
                        <button class="btn btn-info submit" style="font-weight:bold;" value="login" name="login">LOGIN</button>
                    </form>
                </div>
            </div>
            <!-- <div class="login-content">
                <div class="login-body text-center">
                    <h4>Library Login Form</h4>
                    <form action="" method="post">
                        <div class="mb-20">
                            <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div class="mb-20">
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div class="mb-20">
                            <input class="btn btn-info submit" type="submit" name="login" value="Login">

                        </div> -->
            </form>
        </div>

    </div>

    <div class="footer text-center">
        <p>&copy; All rights reserved IT-41 GROUP-1</p>
    </div>

    <script src="inc/js/jquery-2.2.4.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/custom.js"></script>
</body>

</html>
