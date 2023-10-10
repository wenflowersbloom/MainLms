<?php

$page = 'obooks';
include 'inc/header.php';
include 'inc/connection.php';
?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

        #dateTimeDisplay {
            position: absolute;
            top: 10px;
            /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
            font-size: 24px;
            /* Adjust font size as needed */
            font-weight: bold;
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
                    <div class="left">
                        <h2>OVERDUE BOOKS</h2>
                    </div>
        </center>
            <div class="overdue-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rbook-info status">
                            <table id="dtBasicExample" class="table test text-center custom-table">
                                <thead>
                                    <tr>
                                        <th>Books Name</th>
                                        <th>Issue Date</th>
                                        <th>Return Date</th>
                                        <th>Days Overdue</th>
                                        <th>User Type</th>
                                        <th>Id No.</th>
                                        <th>Name</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $current_date = date("Y-m-d");
                                    $res = mysqli_query($link, "SELECT * FROM issue_book WHERE '$current_date' > booksreturndate");
                                    $res2 = mysqli_query($link, "SELECT * FROM t_issuebook WHERE '$current_date' > booksreturndate");

                                    while ($row = mysqli_fetch_array($res)) {
                                        $days_overdue = (strtotime($current_date) - strtotime($row["booksreturndate"])) / (60 * 60 * 24);
                                        echo "<tr>";
                                        echo "<td>" . $row["booksname"] . "</td>";
                                        echo "<td>" . $row["booksissuedate"] . "</td>";
                                        echo "<td>" . $row["booksreturndate"] . "</td>";
                                        echo "<td>" . $days_overdue . "</td>";  // Days overdue column
                                        echo "<td>" . $row["utype"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td><a style='color: #fff;' href='#' onclick='confirmReturn(\"return.php?id=" . $row["id"] . "\")'><i class='fas fa-undo-alt' style='color:white;background-color:darkgreen;padding:17px;border-radius:20px;'></i></a></td>";

                                        echo "</tr>";
                                    }
                                    while ($row = mysqli_fetch_array($res2)) {
                                        $days_overdue = (strtotime($current_date) - strtotime($row["booksreturndate"])) / (60 * 60 * 24);
                                        echo "<tr>";
                                        echo "<td>" . $row["booksname"] . "</td>";
                                        echo "<td>" . $row["booksissuedate"] . "</td>";
                                        echo "<td>" . $row["booksreturndate"] . "</td>";
                                        echo "<td>" . $days_overdue . "</td>"; // Days overdue column
                                        echo "<td>" . $row["utype"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td><a href='#' onclick='confirmReturn(\"return.php?id=" . $row["id"] . "\")'><i class='fas fa-undo-alt'></i></a></td>";
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
</div>

<?php
include 'inc/footer.php';
?>



<script>
    function confirmReturn(url) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Book returned successfully',
            confirmButtonColor: '#008000',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
