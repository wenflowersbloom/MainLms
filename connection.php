<?php 

	 $link= mysqli_connect("localhost:3307","root","");
     mysqli_select_db($link, "capstone1db");
     if(! $link ){
        die('Could not connect: ' . mysqli_error());
     }
 ?>


