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
    background-color: white;
    min-height: 180vh;
    background-size: cover;
    position: relative;
    z-index: 1;
}


.header {
    position: fixed;
    width: 100%;
    height: 100px;
    background-image: url(./upload/headerbg.png);
    border: 0;
    z-index: 2;
    margin-top: -100px;
}
    .dbooks{
        justify-content: center;
    }

@media (min-width: 700px) {
    .header {
        height: 15vh;
    }
    .dashboard-content {
        background-color: white;
        min-height: 110vh;
    }

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
<?php
include 'inc/connection.php';
?>

<!--dashboard area-->
<div class="dashboard-content">
<div class="header">
        <center><img src="./upload/logo5.png" style="width:500px;@media only screen and (-webkit-min-device-pixel-ratio: 2.75) {width:300px;}"></img></center>
    </div>
    <div class="dashboard-header">
        <div class="container" style="margin-top:100px;">
            <center>
                <div class="col-md-6">
                    <div class="left" style="color: black;">

                        <h2 style="padding: 0 0 0; margin: 0 0 0;font-weight:bold;">AVAILABLE BOOKS</h2>
                    </div>
                </div>

            </center>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="department-filter">
                        <select id="deptFilter" class="form-control custom-select" style="width: 150px;border-color:black;">
                            <option value="none">CAS</option>
                            <option value="CCJ">CCJ</option>
                            <option value="CED">CED</option>
                            <option value="CAS">CET</option>
                            <option value="CHS">CHS</option>
                            <option value="CBA">CBA</option>
                            <option value="SHS">SHS</option>
                        </select>
                    </div>

                    <div class="dbooks">


                        <table id="dtBasicExample" class="table test text-center custom-table">

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

});

</script>

</body>

</html>