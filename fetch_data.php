<?php
include 'inc/connection.php';

$timeframe = $_GET['timeframe'];
$sql = '';

switch ($timeframe) {
    case 'daily':
        $sql = "SELECT std_college, COUNT(*) as count 
                FROM tbl_attendance 
                WHERE DATE(timein) = CURDATE() 
                GROUP BY std_college";
        break;
    case 'weekly':
        $sql = "SELECT std_college, COUNT(*) as count 
                FROM tbl_attendance 
                WHERE WEEK(timein) = WEEK(CURDATE()) 
                GROUP BY std_college";
        break;
    case 'monthly':
        $sql = "SELECT std_college, COUNT(*) as count 
                FROM tbl_attendance 
                WHERE MONTH(timein) = MONTH(CURDATE()) 
                GROUP BY std_college";
        break;
}

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#timeframe').on('change', function() {
        let timeframe = $(this).val();
     
    });
    // Trigger change to load daily data by default
    $('#timeframe').trigger('change');
});
</script>
