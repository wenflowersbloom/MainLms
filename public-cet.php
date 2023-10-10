<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/datatables.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/75e838629a.js" crossorigin="anonymous"></script>
    <style>
        /* Styles for the modal dialog */
        .modal {
            display: none;
            /* Hide the modal by default */
            position: fixed;
            z-index: 1;
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

        h2 {
            font-weight: bold;
        }

        .dashboard-content {
            background-image: url(inc/img/newbg.png);
            background-size: cover;
            height: 100.5vh;
            margin-bottom: -70px;
            margin-left: -50px;
        }
    </style>
</head>
<?php
include 'inc/connection.php';
?>

<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <center>
                <div class="col-md-6">
                    <div class="left" style="color: white;">

                        <h2 style="padding: 0 0 0; margin: 0 0 0;font-weight:bold;">AVAILABLE BOOKS</h2>
                    </div>
                </div>

            </center>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="department-filter">
                        <select id="deptFilter" class="form-control custom-select" style="width: 150px;">
                            <option value="none">CET</option>
                            <option value="CCJ">CCJ</option>
                            <option value="CED">CED</option>
                            <option value="CAS">CAS</option>
                            <option value="CHS">CHS</option>
                            <option value="CBA">CBA</option>
                            <option value="SHS">SHS</option>
                        </select>
                    </div>

                    <div class="dbooks">


                        <table id="dtBasicExample" class="table table-striped table-dark text-center">

                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Book Title</th>
                                    <th>Author Name</th>
                                    <th>Publisher</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Availability</th>
                                    
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
                                    echo $row["books_quantity"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["books_availability"];
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



</div>
<?php
include 'inc/footer.php';
?>
<script>
  $(document).ready(function() {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');

    var table = $('#dtBasicExample').DataTable();

    // Handle department filter change
    $('#deptFilter').on('change', function() {
        var selectedDept = $(this).val();

        // Filter the DataTable based on the selected department
        if (selectedDept === 'none') {
            table.column(0).search('').draw();
        }  else {
            // Filter the DataTable to show only the selected department
            table.column(0).search(selectedDept).draw();
        }
    });

    // Initially, filter the DataTable to show only CET books
    table.column(0).search('CET').draw();
});

</script>

</body>

</html>