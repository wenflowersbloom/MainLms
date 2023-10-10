<?php

$page = 'ibook';
include 'inc/header.php';
include 'inc/connection.php';
?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        * {
            color: white;
        }

        h2 {
            font-weight: bold;
        }

        .dashboard-content {
            background-image: url(./inc/img/newbg.png);
            height: 100.5vh;
            background-size: cover;
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
    </style>
</head>
<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <h2>OVERDUE BOOKS</h2>
                    </div>
                </div>
            </div>
            <div class="overdue-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rbook-info status">
                            <table id="dtBasicExample" class="table table-striped table-dark text-center">
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
                                        echo "<td><a style='color: #fff;' href='#' onclick='confirmReturn(\"return.php?id=" . $row["id"] . "\")'><i class='fas fa-undo-alt'></i></a></td>";

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
