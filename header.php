<?php
include 'connection.php';
session_start();
if (!isset($_SESSION["username"])) {
?>
	<script type="text/javascript">
		window.location = "../login.php";
	</script>
<?php
}
$not = 0;
$res = mysqli_query($link, "select * from request_books where read1='no'");
$not = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Library Management System</title>
	<link rel="stylesheet" href="inc/css/bootstrap.min.css">
	<link rel="stylesheet" href="inc/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="inc/css/datatables.min.css">
	<link rel="stylesheet" href="inc/css/pro1.css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<script src="https://kit.fontawesome.com/75e838629a.js" crossorigin="anonymous"></script>


	<style>
		* {
			font-family: 'Poppins';
		}

		.logout {
			display: inline-block;
			position: relative;
			color: white;
			font-size: 23px;
			margin-right: 10px;
			font-weight: bold;
			padding: 2px;
			cursor: pointer;
		}

		.logout::after {
			content: '';
			position: absolute;
			width: 100%;
			transform: scaleX(0);
			height: 5px;
			bottom: 0;
			left: 0;
			background-color: gold;
			transform-origin: center;
			transition: transform 0.25s ease-out;
			border-radius: 15px;

		}

		.logout:hover::after {
			transform: scaleX(1);
			transform-origin: center;

		}

		.logout:hover {
			color: gold;
			cursor: pointer;
		}

		h1 {
			font-family: "Century Gothic",
				CenturyGothic, AppleGothic, sans-serif;
			font-size: 24px;
			font-style: normal;
			font-variant: normal;
			font-weight: 700;
			line-height: 26.4px;
		}

		h3 {
			font-family: "Century Gothic",
				CenturyGothic, AppleGothic, sans-serif;
			font-size: 14px;
			font-style: normal;
			font-variant: normal;
			font-weight: 700;
			line-height: 15.4px;
		}

		ul {
			font-family: "Century Gothic",
				CenturyGothic, AppleGothic, sans-serif;
			font-size: 16px;
			font-style: normal;
			font-variant: normal;
			font-weight: 300;
			line-height: 15.4px;
		}

		li {
			font-family: "Century Gothic",
				CenturyGothic, AppleGothic, sans-serif;
			font-size: 13px;
			font-style: normal;
			font-variant: normal;
			font-weight: 100;
			line-height: 15.4px;
		}

		.logo {
			width: 220px;
			height: auto;
			margin-top: 10px;
		}

		hr {
			border: 1px solid white;
		}

		.sidebar-menu .menu.active a {
			background-image: url(./inc/img/newbg.png);
			color: black;
			border-radius: 50px;
			color: gold;
			border-top-left-radius: 10px;
			border-bottom-left-radius: 40px;
			border-bottom-right-radius: 0px;
			border-top-right-radius: 0px;
		}

		.form-control custom-select {
			color: black;
		}


		.left-sidebar {
			z-index: 2;
			/* Ensure the sidebar is in front of content */
		}

		.content {
			position: relative;
		}
	</style>
</head>

<body>
	<div class="main-content" style="width:100%">
		<div class="wrapper">
			<div class="left-sidebar bg-success border" style="position: fixed; height: 100%; background-image:url(./upload/sidebarbg.png); border:0;">
				<div class="text-center">
					<img class="img-fluid logo" src="./upload/logo4.png">
				</div>
				<!-- <img class="img-fluid logo" src="./upload/logo.png"> -->





				<div class="gap-40"></div>
				<div class="profile" style="height:130px;padding-top:15px;padding-bottom:10px;margin-bottom:-60px;margin-top:-40px;">

					<div class="profile-pic" style="margin-left:8px;">
						<a href="profile.php">
							<?php
							$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
							while ($row = mysqli_fetch_array($res)) {
							?><img src="<?php echo $row["photo"]; ?> " height="" width="" alt="something wrong" class="rounded-circle"></a> <?php
																																		}
																																			?>
					</a>
					</div>
					<div class="profile-info mt-3 text-center" style="margin-left:-8px;">
						<?php
						$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
						while ($row = mysqli_fetch_array($res)) {
							$role = $row["role"];
							echo '<span>' . $role . '</span>';
							$name = $row["name"];
							echo '<h2>' . $name . '</h2>';
						}
						?>
					</div>
				</div>

				<div class="sidebar-menu">

					<ul>
						<li class="menu <?php if ($page == 'home') {
											echo 'active';
										} ?>">
							<a href="dashboard.php" style="font-weight: bold;"><i class="fas fa-home" style="color:gold;"></i>Dashboard</a>
						</li>
						<li class="menu <?php if ($page == 'sinfo') {
											echo 'active';
										} ?>">
							<a href="all-student-info.php" style="font-weight: bold;"><i class="fas fa-desktop" style="color:gold;"></i>Student Information</a>
						</li>
						<li class="menu <?php if ($page == 'tinfo') {
											echo 'active';
										} ?>">
							<a href="all-teacher-info.php" style="font-weight: bold;"><i class="fas fa-desktop" style="color:gold;"></i>Faculty Information</a>
						</li><li class="menu <?php if ($page == 'profile') {
											echo 'active';
										} ?>">
							<a href="profile.php" style="font-weight: bold;"><i class="fas fa-users" style="color:gold;"></i>Profile</a>
						</li>
						<li class="menu <?php if ($page == 'dbooks') {
											echo 'active';
										} ?>">
							<a href="display-books.php" style="font-weight: bold;"><i class="fas fa-list-alt" style="color:gold;"></i>Display Books</span></a>
						</li>
						<li class="menu menu-toggle1" > 
							<a href="#" style="font-weight: bold;"><i class="fas fa-list-alt" style="color:gold;"></i>Manage Books <span class="fa fa-chevron-down"></span></a>
							<ul class="menus1">
								<li><a href="issued-books.php">Borrowed Books</a></li>
								<li><a href="overdue-books.php">Overdue Books</a></li>
								<li><a href="archived-books.php">Archived Books</a></li>
								<li><a href="student-issue-book.php">student issue book</a></li>
								<li><a href="teacher-issue-book.php">Faculty issue book</a></li>
							</ul>
						</li>
						<?php
						if ($_SESSION["role"] == "ADMIN") {
						?>
							<li class="menu menu-toggle3">
								<a href="#" style="font-weight: bold;"><i class="fas fa-users" style="color:gold;"></i>manage users <span class="fa fa-chevron-down"></span></a>
								<ul class="menus3">
									<li><a href="sasqrcode/generator.php">Add Student</a></li>
									<!--<li><a href="fine.php">Penalized</a></li>-->
									<li><a href="sasqrcode/generator2.php">Add Faculty</a></li>
								</ul>
							</li>
							<li class="menu " style="font-weight: bold;">
								<a href="registration.php"><i class="fa-solid fa-address-card" style="color:gold;"></i>Register Account</span></a>
							</li>

							<li class="menu <?php if ($page == 'analytics') {
											echo 'active';
										} ?>">
								<a href="analytics.php"><i class="fa-solid fa-chart-simple" style="color:gold;"></i>Data Analytics</span></a>
							</li>
						
						<?php
						}
						?>



						<div class="gap-30"></div>
						<div class="gap-30"></div>
						<div class="gap-30"></div>
						<div class="gap-30"></div>
						<div class="gap-30"></div>
						<div class="gap-30"></div>


					</ul>
				</div>
			</div>


			<div class="content" style="width: 83%;">
				<div class="inner bg-success border" style="z-index:2;position: fixed;margin-left:1%;width: 83%; background-image:url(./upload/headerbg.png)">
					<div class="heading text-left mt-2">
						<h3>
							<search>
					</div>

					<div class="header-profile text-right">
						<?php
						$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
						$_SESSION['user'] = 'username';

						if (!isset($_SESSION['user'])) {
							header('Location: login.php');
							exit();
						}
						?>
						<span class="logout" style="background-color:none; padding:0; border-radius:0;" onclick="myFunction()"> Logout </span>
						<script>
							function myFunction() {
								if (confirm("Are you sure?")) {
									window.location.href = "login.php";
								} else {}
							}
						</script>
					</div>
				</div>