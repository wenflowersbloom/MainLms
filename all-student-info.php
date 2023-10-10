<!DOCTYPE html>

<?php
$page = 'sinfo';
include 'inc/header.php';
include 'inc/connection.php';
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>

        h2 {
            font-weight: bold;
        }

        .dashboard-content {
            background-color: white;
            height: 91.8vh;
            background-size: cover;
            margin-top: 60px;
    		z-index: 1;
        }

        select.custom-select {
            background-color: white;
            border: 1px solid white;
        }

        select.custom-select option {
            background-color: white;
            color: black;
        }

        select.custom-select:hover,
        select.custom-select:focus {
            background-color: white;
        }

        /* Customize the modal size */
        .modal-dialog {
            max-width: 400px;
            margin: 30px auto;
            z-index:3;
        }

        /* Adjust modal content padding and border */
        .modal-content {
            padding: 10px;
            border-radius: 5px;
            border: none;
        }

        /* Adjust modal header, body, and footer padding */
        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 10px 15px;
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
</head>
<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <center>
                <div class="col-md-6">
                    <div class="left" style="color:black">
                        <h2>STUDENT INFORMATION</h2>
                    </div>
                    <div class="department-filter">
                        <select id="deptFilter" class="form-control custom-select" style="width: 150px;border-color:black;">
                            <option value="none">Department</option>
                            <option value="CAS">CAS</option>
                            <option value="CET">CET</option>
                            <option value="CED">CED</option>
                            <option value="CET">CET</option>
                            <option value="CBA">CBA</option>
                            <option value="CHS">CHS</option>
                            <option value="CCJ">CCJ</option>
                            <!-- Add more departments as needed -->
                        </select>
                    </div>
                </div>
            </center>

            <!-- Edit Student Information Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="color: black;">Edit Student Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <form id="editForm">
                                <div class="form-group">
                                    <label for="editStdName" style="color: black;">Student No.</label>
                                    <input type="text" class="form-control" id="editStdNo" name="std_no" value="<?php echo $std_no; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="editStdName" style="color: black;">Name</label>
                                    <input type="text" class="form-control" id="editStdName" name="std_name">
                                </div>
                                <div class="form-group">
                                    <label for="editStdCourse" style="color: black;">Department</label>
                                    <input type="text" class="form-control" id="editStdCourse" name="std_college">
                                </div>
                                <div class="form-group">
                                    <label for="editStdEmail" style="color: black;">Email</label>
                                    <input type="email" class="form-control" id="editStdEmail" name="std_email">
                                </div>
                                <button type="submit" class="btn btn-primary" style="background-color: green; color: white;">Save </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="student-wrapper">
        <div class="container">
            <div class="row" style="border-color:black;">
                <div class="col-md-12" style="border-color:black;">
                    <div class="std-info">
                        <table id="dtBasicExample" class="table test text-center custom-table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>Name</th>
                                    <th id="deptColumn">Dept</th>
                                    <th>Email</th>
                                    <th>Option</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = mysqli_query($link, "select * from tbl_student");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $row["std_no"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["std_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["std_college"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["std_email"];
                                    echo "</td>";
                                    echo '<td>';
                                    echo '<button class="btn btn-primary edit-btn" style="background-color:darkgreen;color:white;" data-stdno="' . $row["std_no"] . '" data-stdname="' . $row["std_name"] . '" data-stdcourse="' . $row["std_college"] . '" data-stdemail="' . $row["std_email"] . '">Edit</button>';
                                    echo '</td>';
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
</div>
<?php
include 'inc/footer.php';
?>
<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');

        // Handle edit button click
        $('#dtBasicExample').on('click', '.edit-btn', function() {
            // Get student data from data attributes
            let stdNo = $(this).data('stdno');
            let stdName = $(this).data('stdname');
            let stdCourse = $(this).data('stdcourse');
            let stdEmail = $(this).data('stdemail');

            // Populate the modal form with student data
            $('#editStdNo').val(stdNo);
            $('#editStdName').val(stdName);
            $('#editStdCourse').val(stdCourse);
            $('#editStdEmail').val(stdEmail);

            // Show the modal
            $('#editModal').modal('show');
        });

        // Handle the form submission
        $('#editForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Perform AJAX request to update the student data
            $.ajax({
                url: 'update_student.php', // Endpoint to update student data
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Trim any leading or trailing whitespace from the response
                    response = response.trim();
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Changes are saved!',
                            confirmButtonText: 'Okay',
                            confirmButtonColor: '#008000',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page to reflect the changes
                            }
                        })

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error in saving your changes.',
                            text: 'Something went wrong!',
                            confirmButtonText: 'Okay',
                            confirmButtonColor: '#008000',
                        }).then((result) => {
                            location.reload();
                        })
                    }
                }
            });
        });




        var table = $('#dtBasicExample').DataTable();

        // Handle department filter change
        $('#deptFilter').on('change', function() {
            var selectedDept = $(this).val();

            // Filter the DataTable based on selected department
            if (selectedDept === 'none') { // 'none' is the value for the default option "Department"
                table.column(2).search('').draw();
            } else {
                table.column(2).search(selectedDept).draw();
            }
        });

    });
</script>

</html>