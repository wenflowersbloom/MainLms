<?php
$page = 'abook';
include 'inc/header.php';
include 'inc/connection.php';
?>
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
<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
        <center>
                <div class="col-md-6">
                    <div class="left">
                        <h2>ARCHIVED BOOKS</h2>
                    </div>
        </center>
            <div class="issued-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rbook-info status">
                            <table id="dtBasicExample" class="table test text-center custom-table">
                                <thead>
                                    <tr>
                                        <th>User Type</th>
                                        <th>Books Name</th>
                                        <th>Date Returned</th>
                                        <th>Student #</th>
                                        <th>Name</th>
                                        <th>College</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($link, "select * from archive_books");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row["utype"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["books_name"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["book_returned_date"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["std_no"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["std_name"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["std_course"];
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
</div>
<?php
include 'inc/footer.php';
?>
<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>