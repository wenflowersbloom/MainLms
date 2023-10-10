<?php

$page = 'ibook';
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
                        <h2>BORROWED BOOKS</h2>
                    </div>
    </center>
            <div class="issued-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rbook-info status">
                            <table id="dtBasicExample" class="table test text-center custom-table">
                                <thead>
                                    <tr>
                                        <th>Books Name</th>
                                        <th>Issue Date</th>
                                        <th>Return Date</th>
                                        <th>User Type</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Return Book</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($link, "select * from issue_book");
                                    $res2 = mysqli_query($link, "select * from t_issuebook");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row["booksname"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["booksissuedate"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["booksreturndate"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["utype"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["name"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["email"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo '<a style="color: #fff;" href="return.php?id=';
                                        echo $row["id"];
                                        echo '"><i class="fas fa-undo-alt" style="color:white;background-color:darkgreen;padding:17px;border-radius:20px;"></i></a>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    while ($row = mysqli_fetch_array($res2)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row["booksname"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["booksissuedate"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["booksreturndate"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["utype"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["name"];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row["email"];
                                        echo "</td>";
                                        echo "<td>";
                                    ?>
                                        <ul>
                                            <li><a href="return.php"?id=<?php echo $row["id"]; ?>"><i class="fas fa-undo-alt"></i></a></li>
                                        </ul>
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