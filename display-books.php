<!DOCTYPE html>
<style>
    /* Styles for the modal dialog */
    .modal {
        display: none;
        /* Hide the modal by default */
        position: fixed;
        z-index: 2;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        margin: 10% auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    /* Styles for buttons */
    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }

    .btn-cancel {
        background-color: #dc3545;
    }


    .dashboard-content {
            background-color: white;
            height: 110vh;
            background-size: cover;
            margin-top: 60px;
    		z-index: 1;
        }
    .row{
            color:white;
        }
        .btn-primary{
            border-color: darkgreen;
        }
        .btn-primary:hover{
            border-color:lightgreen;
        }
        .row{
            color:black;
        }
        .test{
            color:black;
        }

        .test{
            border:1px black;
            margin-top:20px;
            background-color: #e6e6e6ff;
        }
        .custom-table {
            border-collapse: collapse; 
            width: 100%;
        }

        /* Style for table headers */
        .custom-table th {
            border: 1px solid black; 
            padding: 8px;
            background-color: darkgreen;
            color:white; 
        }

        /* Style for table data cells */
        .custom-table td {
            border: 1px solid black; 
            padding: 8px; 
        }
        .custom-select{
            border-color:black;
        }
</style>

<?php
$page = 'dbooks';
include 'inc/header.php';
include 'inc/connection.php';
?>

<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <center>
                <div class="col-md-6">
                    <div class="left" style="color: black;">

                        <h2 style="padding: 0 0 0; margin: 0 0 0;font-weight:bold;">ALL BOOKS</h2>
                    </div>
                </div>
                <div class="department-filter">
                        <select id="deptFilter" class="form-control custom-select" style="width: 150px;border-color:black;">
                            <option value="none">Section</option>
                            <option value="CET">CET</option>
                            <option value="CCJ">CCJ</option>
                            <option value="CED">CED</option>
                            <option value="CAS">CAS</option>
                            <option value="CHS">CHS</option>
                            <option value="CBA">CBA</option>
                            <option value="SHS">SHS</option>
                        </select>
                    </div>
                    
            </center>
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    

                    <div class="dbooks">
                        <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addBookModal" style="float: right; margin-top:-200px;background-color:green;">Add</button>

                        <table id="dtBasicExample" class="table test text-center custom-table " style="margin-top:1%;">

                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Book Title</th>
                                    <th>Author Name</th>
                                    <th>Publisher</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Availability</th>
                                    <th>Option</th>
                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                $res = mysqli_query($link, "select * from add_book");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $row["books_sec"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_author_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_publication_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_purchase_date"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_price"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_quantity"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_availability"];
                                    echo "</td>";
                                    echo "<td>";
                                ?>
                                    <a href="delete-book.php?id=<?php echo $row["id"]; ?> "><i class="fas fa-trash"></i></a>
                                <?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    <!-- Add form fields for book details -->
                    <form id="addBookForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="f1">Book Cover</label>
                            <input type="file" class="form-control" name="f1" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <label for="booksname">Book Title<span style="color:red;" class="required"> *</span></label>
                            <input type="text" class="form-control" id="booksname" name="booksname" required>
                            <span id="booksnameError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="bauthorname">Book Author<span style="color:red;" class="required"> *</span></label>
                            <input type="text" class="form-control" id="bauthorname" name="bauthorname" required>
                            <span id="bauthornameError" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="bpubname">Publisher</label>
                            <input type="text" class="form-control" id="bpubname" name="bpubname">

                        </div>
                        <div class="form-group">
                            <label for="bpurcyear">Copyright Year<span style="color:red;" class="required"> *</span></label>
                            <input type="text" class="form-control" id="bpurcyear" name="bpurcyear" required>
                            <span id="bpurcyearError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="bprice">Price</label>
                            <input type="number " class="form-control" id="bprice" name="bprice" required>
                        </div>
                        <div class="form-group">
                            <label for="bquantity">Quantity</label>
                            <input type="number" class="form-control" id="bquantity" name="bquantity" required>
                        </div>
                        <div class="form-group">
                            <label for="bavailability">Availability</label>
                            <input type="number" class="form-control" id="bavailability" name="bavailability" required>
                        </div>


                        <!-- Add more form fields here for other details -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addBookButton">Add Book</button>
                </div>
            </div>




        </div>
    </div>

</div>
<?php
include 'inc/footer.php';
?>
<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    var table = $('#dtBasicExample').DataTable();

    // Handle department filter change
    $('#deptFilter').on('change', function() {
        var selectedDept = $(this).val();

        // Filter the DataTable based on the selected department
        if (selectedDept === 'none') {
            table.column(0).search('').draw();
        } else {
            table.column(0).search(selectedDept).draw();
        }
    });
</script>

<?php
if (isset($_POST["addBookButton"])) {
    $image_name = $_FILES['f1']['name'];
    $booksname = $_POST["booksname"];
    $bauthorname = $_POST["bauthorname"];
    $bpurcdate = $_POST["bpurcdate"];
    $bpubname = $_POST["bpubname"];
    $bprice = $_POST["bprice"];
    $bquantity = $_POST["bquantity"];
    $bavailability = $_POST["bavailability"];

    // Image path
    $fileExtension = pathinfo($image_name, PATHINFO_EXTENSION);
    $imagepath = "books-image/" . '.' . $fileExtension;
    // $temp = explode(".", $image_name);
    // $newfilename = round(microtime(true)) . '.' . end($temp); // Keep the original file extension
    // $imagepath = "books-image/" . $newfilename;
    move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath);



    // Perform the database insertion
    mysqli_query($link, "INSERT INTO add_book (books_image, books_name, books_author_name, books_purchase_date, books_publication_name, books_price, books_quantity, books_availability) VALUES ('$imagepath', '$booksname', '$bauthorname', '$bpurcdate', '$bpubname', '$bprice', '$bquantity', '$bavailability')");
}

?>



<script>
    $(document).ready(function() {
        $('#addBookButton').click(function() {
            var booksname = $('#booksname').val();
            var bauthorname = $('#bauthorname').val();
            var bpurcdate = $('#bpurcdate').val();
            var bpubname = $('#bpubname').val();
            var bprice = $('#bprice').val();
            var bquantity = $('#bquantity').val();
            var bavailability = $('#bavailability').val();

            //Validate fields

            var valid = true;

            if (booksname === "") {
                $('#booksnameError').text('Please fill out this field');
                valid = false;
            }

            if (bauthorname === "") {
                $('#bauthornameError').text('Please fill out this field');
                valid = false;
            }

            // Other validations...

            if (!valid) {
                return; // Don't proceed if there are errors
            }

            var copyrightYear = document.getElementById("bpurcyear").value.trim();

            // Check if the copyrightYear is a valid four-digit number
            var yearPattern = /^[0-9]{4}$/;

            if (!yearPattern.test(copyrightYear)) {
                // Display an error message if the year is not valid
                document.getElementById("bpurcyearError").textContent = "Please enter a valid four-digit year.";
                return; // Prevent form submission if the year is not valid
            }


            $.ajax({
                type: 'POST',
                url: 'display-books.php', // Use the current page URL
                data: {
                    addBookButton: true, // Add this flag to indicate form submission
                    booksname: booksname,
                    bauthorname: bauthorname,
                    bpubname: bpubname,
                    bpurcdate: bpurcdate,
                    bprice: bprice,
                    bquantity: bquantity,
                    bavailability: bavailability


                },
                success: function(response) {
                    alert('Book added successfully!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error adding book: ' + error);
                }
            });

            $('#addBookModal').modal('hide');
        });
    });
</script>
</body>

</html>