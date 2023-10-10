<?php 
    $page = 'home';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <style>
		h2{
        font-weight: bold;
    	}
		*{
		text-decoration: none !important;
		}
        .dashboard-content {
            background-color: white;
            height: 91.8vh;
            background-size: cover;
            margin-top: 60px;
    		z-index: 1;
        }
		h4{
			font-size:40px;
			font-weight: bold;
			color:black;
		}
		.p1{
			display: flex;
 			justify-content: left;
			float:left;
		}

    </style>
</head>
	<!--dashboard area-->
	<div class="dashboard-content img-fluid">
		<div class="dashboard-header">
			<div class="container">
				<div class="logos">
					<center>
					<img src="upload/homelogos.png" style="width: 150px;padding:.9%;"></img>
					<h4>Universidad De Manila Library</h4>
					</center>
				</div>
				<div class="p1">
					<p style="color:black;float:right;margin-top:3%">
					Universidad de Manila, also referred to by its acronym UdM, is a public coeducational city government 
					funded higher education institution in Manila, Philippines. It was founded in April 26, 1995 with the 
					approval by Mayor Alfredo Lim of Manila City Ordinance (MCO) No. 7885 “An Ordinance Authorizing the City 
					Government of Manila to Establish and Operate the Dalubhasaan ng Maynila (City College of Manila)". It 
					offers both academic and technical-vocational courses and programs.
					<br><br>
					Its Main Campus is located at the grounds of Mehan Gardens, Ermita in front of the Bonifacio Shrine 
					(Kartilya ng Katipunan) and beside the Central Terminal station of LRT Line 1. It has a satellite Campus 
					(UDM Annex) along Carlos Palanca Street in Santa Cruz.
					</p>
					<img src="inc/img/p1.jpg" style="float:left;width:300px;border-radius:30px;margin-top:3%"></img>
				</div>
			</div>					
		</div>
	</div>
	<?php 
		include 'inc/footer.php';
	 ?>