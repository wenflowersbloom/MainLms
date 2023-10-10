	<?php 
		 session_start();
		if (!isset($_SESSION["username"])) {
            ?>
                <script type="text/javascript">
                    window.location="login.php";
                </script>
            <?php
        }
        include 'inc/header.php';
        include 'inc/connection.php';
	 ?>
			
	<!--dashboard area-->
	<div class="dashboard-content">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<p><span>dashboard</span>Control panel</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="right text-right">
							<a href="dashboard.php"><i class="fas fa-home"></i>home</a>
							<span class="disabled">add book</span>
						</div>
					</div>
				</div>
				<div class="bstore">
					<form action="" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                <label for="booksname">Book Title<span style ="color:red;" class="required"> *</span></label>
                                   <input type="text" class="form-control" name="booksname" placeholder="Book Title" required=""> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Books image
                                    <input type="file" class="form-control" name="f1" >
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    Books file
                                    <input type="file" class="form-control" name="file" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <label for="booksname">Author's Name<span style ="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="bauthorname" placeholder="Author's Name" required="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <label for="booksname">Publisher<span style ="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="bpubname" placeholder="Publisher" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <label for="booksname">Publication Date<span style ="color:red;" class="required"> *</span></label>
                                    <input type="date" class="form-control" name="bpurcdate" placeholder="Publication Date" required="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="bprice" placeholder="Books price" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="bquantity" placeholder="Books quantity" required="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="bavailability" placeholder="Books availability" >
                                </td>
                            </tr>
                        </table>
                        <div class="submit mt-20">
                        	<input type="submit" name="submit" class="btn btn-info submit" value="Add Book">
                        </div>
                	</form>
				</div>				
			</div>					
		</div>
	</div>

        <?php

            if (isset($_POST["submit"])) {

                $image_name=$_FILES['f1']['name'];
                $file_name=$_FILES['file']['name'];
                $temp = explode(".", $image_name);
                $temp2 = explode(".", $file_name);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $newfilename2 = round(microtime(true)) . '.' . end($temp2);
                $imagepath="books-image/".$newfilename;
                $filepath="books-file/".$newfilename2;
                move_uploaded_file($_FILES["f1"]["tmp_name"],$imagepath);
                move_uploaded_file($_FILES["file"]["tmp_name"],$filepath);

                 mysqli_query($link, "insert into add_book values('','$_POST[booksname]','$imagepath','$_POST[bauthorname]','$_POST[bpubname]','$_POST[bpurcdate]','$_POST[bprice]','$_POST[bquantity]','$_POST[bavailability]','$_SESSION[username]','$filepath')");

            }
        ?>
			
	<?php 
		include 'inc/footer.php';
	 ?>