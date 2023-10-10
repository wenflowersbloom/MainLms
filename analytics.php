<?php
$page = 'analytics';
include 'inc/header.php';
include 'inc/connection.php';

// Retrieve the "timein" data from the database and store it in $datePart
$sql = "SELECT timein FROM tbl_attendance"; // Adjust the query as per your database structure
$getDept = "SELECT std_college FROM tbl_attendance";
$getAll = "SELECT * FROM tbl_attendance";

$result = mysqli_query($link, $sql);
$getallResult = mysqli_query($link, $getAll);
$getDeptResult = mysqli_query($link, $getDept);

// Check if the query was successful

if ($getallResult) {
    $attendanceArray = array();

    // Fetch each row and add it to the array
    while ($row = $getallResult->fetch_assoc()) {
        $attendanceArray[] = array_values($row); // Convert associative array to indexed array
    }

    $attendanceJson = json_encode($attendanceArray);
}

if ($getDeptResult) {
    $deptArray = []; // Initialize an empty array to store date values

    // Loop through the result set to extract and store date values
    while ($row = mysqli_fetch_assoc($getDeptResult)) {
        // Extract the "timein" value
        $dept = $row['std_college'];

        // Push the datePart into the array
        $deptArray[] = $dept;
    }

    // JSON encode the datePartArray for JavaScript
    $deptArrayJson = json_encode($deptArray);
}

if ($result) {
    $datePartArray = array(); // Initialize an empty array to store date values

    $headerRow = array("ID", "Student Number", "Student Name", "Student Program", "Time In", "Student College");
    // Loop through the result set to extract and store date values
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the "timein" value
        $timein = $row['timein'];
        $datePart = date('Y-m-d', strtotime($timein));

        // Push the datePart into the array
        $datePartArray[] = $datePart;
    }

    // JSON encode the datePartArray for JavaScript
    $datePartJSON = json_encode($datePartArray);
} else {
    // Handle the query error here
    echo "Error: " . mysqli_error($link);
}

// Close the database connection
mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        h2 {
            font-weight: bold;
        }

        .dashboard-content {
            background-color:white;
            height: 100.5vh;
            background-size: cover;
        }

        .p1 {
            display: flex;
            justify-content: center;
            float: left;
        }

        #graph-container {
            display: flex;
            /* Use flexbox for layout */
            justify-content: space-between;
            /* Add space between graphs */
            margin-top: 2%;
            margin-right:5.5%;
            margin-left:5.5%;
        }

        /* Style individual graph containers */
        .chart-container {
            width: 30%;
            padding:10px;
            border-radius: 20px;
            /* Set the width for each graph */
            border: 2px solid black;
            /* Add a border for visualization */
            background-color: rgba(61, 66, 65, 0.95);
            height: auto;
        }

        /* Style the canvas element */
        canvas {
            width: 100%;
            height: 100%;

        }
        .myDiv {
            border: 3px solid black;
            text-align: center;
            display: flex;
            border-radius: 20px;
            flex-wrap: wrap;
            margin-left: 3%;
            margin-right: 3%;
            background-color: rgba(61, 66, 65, 0.95);
            
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            overflow: auto;
            /* Add overflow property to make it scrollable */
            max-height: 800px;
            /* Set a maximum height for the container */
        }

        .attendance-result {
            font-weight: bold;
            margin: 5px;
            padding: 2%;
            box-sizing: border-box;
            color:white;
            /* Include padding and border in element size */
        }

        .center {
            font-weight: bold;
            color:white;
            display: flex;
            justify-content: center;
            /* Center vertically */
            align-items: center;
            /* Center horizontally */
            text-align: center;
            padding: 2%;
        }
    </style>
</head>

<body>
    <!--dashboard area-->

    <!-- Graph-->
    <div class="dashboard-content">
        <br>
        <label for="exportTimeframe" style="color: white; margin-top: 4%; margin-left: 2%;">Select Timeframe for Export:</label><br>
        <select id="exportTimeframe" style="margin-left: 2%;padding:0.5%;border-radius:20px;border: 3px solid black;">
            <option value="this_week">This Week</option>
            <option value="1_week">1 Week Ago</option>
            <option value="2_weeks">2 Weeks Ago</option>
            <option value="1_month">This Month</option>
            <option value="All_Time">All Time</option>
        </select>

        <button id="exportButton" style="padding:0.5%;border-radius:20px;border: 3px solid black;">Export to Excel</button>
        <div id="graph-container">
            <div class="chart-container">
                <canvas id="myChart1"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="myChart2"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="myChart3"></canvas>
            </div>
        </div>

        <!-- Create a select menu for time frame options -->
        <form method="post" action="">
            <label for="time_frame" style="margin-left:2%; font-weight:bold;">Select Time Frame:</label>
            <select name="time_frame" style="margin-left: 1%;padding:0.5%;border-radius:20px;border: 3px solid black;" id="time_frame">
                <option value="everyday">a day ago</option>
                <option value="2weeks">2 Weeks Ago</option>
                <option value="1month">1 Month Ago</option>
            </select>
            <input type="submit" style="margin-bottom:2%;margin-top: 2%;margin-left: 2%;padding:0.5%;border-radius:20px;border: 3px solid black;"value="Calculate Attendance">
        </form>
        <div class="myDiv">
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the selected time frame from the form
                $selectedTimeFrame = $_POST["time_frame"];
                $departments = array("CET", "CAS", "CBA", "CHS", "CED", "CCJ");

                include 'inc/connection.php';

                // Define the date range based on the selected time frame
                $dateRange = "";
                
                if ($selectedTimeFrame === "everyday") {
                    $dateRange = "CURDATE()";
                } elseif ($selectedTimeFrame === "2weeks") {
                    $dateRange = "DATE_SUB(CURDATE(), INTERVAL 2 WEEK)";
                } elseif ($selectedTimeFrame === "1month") {
                    $dateRange = "DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                }

                // Initialize variables to keep track of the department with the highest attendance
                $highestDepartment = "";
                $highestAttendanceCount = 0;
                
                // Loop through each department and fetch attendance count
                foreach ($departments as $department) {
                    // SQL query to calculate attendance count for the department
                    $departmentAttendanceQuery = "SELECT COUNT(*) AS department_count
								   FROM tbl_attendance
								   WHERE std_college = '$department' AND Timein IS NOT NULL
								   AND timein >= $dateRange";

                    $result = mysqli_query($link, $departmentAttendanceQuery);
                    
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $departmentCount = $row["department_count"];

                        echo "<div class='attendance-result'>";
                        echo "<p>Attendance count for $department: $departmentCount</p>";

                        // Calculate the percentage for this department based on the total attendance
                        $totalAttendanceQuery = "SELECT COUNT(*) AS total_count FROM tbl_attendance WHERE Timein IS NOT NULL";
                        $totalResult = mysqli_query($link, $totalAttendanceQuery);
                        $totalRow = $totalResult->fetch_assoc();
                        $totalAttendance = $totalRow["total_count"];

                        // Calculate the percentage as an integer
                        $percentage = intval((($departmentCount * 1.0) / $totalAttendance) * 100);
                        echo "<p>Percentage: $percentage%</p>";

                        echo "</div>";

                        // Check if this department has a higher attendance count
                        if ($departmentCount > $highestAttendanceCount) {
                            $highestAttendanceCount = $departmentCount;
                            $highestDepartment = $department;
                        }
                    } else {
                        echo "Error fetching data for $department.";
                    }
                }

                // Display the department with the highest attendance

                if (!empty($highestDepartment)) {
                    echo "<div class='center'>";
                    echo "<p>The department with the highest attendance is: $highestDepartment</p>";
                } else {
                    echo "<p>No department data available.</p>";
                }
            }
            ?>
            
    </div>

    <script>
                // data
                var datePart = <?php echo $datePartJSON; ?>;
                var allResult = <?php echo $attendanceJson; ?>;
                var allDept = <?php echo $deptArrayJson; ?>;

                console.log(allDept)
                // Daily
                function isMonday(dateString) {
                    var date = new Date(dateString);
                    if (date.getMonth() == new Date().getMonth()) {
                        return date.getDay() === 1; // Monday is represented by 1 in JavaScript's getDay() method
                    }
                }

                function isTuesday(dateString) {
                    var date = new Date(dateString);
                    if (date.getMonth() == new Date().getMonth()) {
                        return date.getDay() === 2;
                    }
                }

                function isWeds(dateString) {
                    var date = new Date(dateString);
                    if (date.getMonth() == new Date().getMonth()) {
                        return date.getDay() === 3;
                    }
                }

                function isThurs(dateString) {
                    var date = new Date(dateString);
                    if (date.getMonth() == new Date().getMonth()) {
                        return date.getDay() === 4;
                    }
                }

                function isFri(dateString) {
                    var date = new Date(dateString);
                    if (date.getMonth() == new Date().getMonth()) {
                        return date.getDay() === 5;
                    }
                }

                function isSat(dateString) {
                    var date = new Date(dateString);
                    if (date.getMonth() == new Date().getMonth()) {
                        return date.getDay() === 6;
                    }
                }

                // Filter the datePartArray
                var mondayDates = datePart.filter(isMonday);
                var tuesdayDates = datePart.filter(isTuesday);
                var wedsDates = datePart.filter(isWeds);
                var thursDates = datePart.filter(isThurs);
                var friDates = datePart.filter(isFri);
                var satDates = datePart.filter(isSat);

                // Count the number
                var mondayCount = mondayDates.length;
                var tuesdayCount = tuesdayDates.length
                var wedsCount = wedsDates.length
                var thursCount = thursDates.length
                var friCount = friDates.length
                var satCount = satDates.length

                //Weekly
                function isDayOfWeek(dateString, dayOfWeek) {
                    var date = new Date(dateString);
                    return date.getDay() === dayOfWeek;
                }

                // Initialize an array to store the counts for each day of the week
                var dayCounts = [0, 0, 0, 0, 0, 0, 0]; // Sunday to Saturday

                // Loop through the datePart array and count each day of the week
                datePart.forEach(function(dateString) {
                    for (var i = 0; i < 7; i++) {
                        if (isDayOfWeek(dateString, i)) {
                            dayCounts[i]++;
                            break; // Exit the loop once the day is found
                        }
                    }
                });

                //Weekly
                var Week1 = 0
                var Week2 = 0
                var Week3 = 0
                var Week4 = 0
                var Week5 = 0

                // Get the current date
                var currentDate = new Date();

                // Function to get the start and end dates of a week for a given date
                function getWeekDates(date) {
                    var startDate = new Date(date);
                    startDate.setDate(date.getDate() - date.getDay()); // Start from Sunday
                    var endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + 6); // End on Saturday
                    return {
                        start: startDate,
                        end: endDate
                    };
                }

                // Function to get the start and end dates of a week for a given date
                function getWeekDates(date) {
                    var startDate = new Date(date);
                    startDate.setDate(date.getDate() - date.getDay()); // Start from Sunday
                    var endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + 6); // End on Saturday
                    return {
                        start: startDate,
                        end: endDate
                    };
                }

                // Function to calculate the week number for a date within a month
                function getWeekNumber(date) {
                    if (date.getMonth() == new Date().getMonth()) {
                        var year = date.getFullYear();
                        var month = date.getMonth() + 1;
                        var startOfMonth = new Date(year, month - 1, 1);
                        var daysInMonth = new Date(year, month, 0).getDate();
                        var weekNumber = Math.ceil((date.getDate() + startOfMonth.getDay()) / 7);
                        return weekNumber;
                    }
                }

                // Calculate and display the week number for each date
                datePart.forEach(function(dateStr) {
                    var date = new Date(dateStr);
                    var weekNumber = getWeekNumber(date);
                    if (weekNumber == 1) {
                        Week1 = Week1 + 1
                    } else if (weekNumber == 2) {
                        Week2 = Week2 + 1
                    } else if (weekNumber == 3) {
                        Week3 = Week3 + 1
                    } else if (weekNumber == 4) {
                        Week4 = Week4 + 1
                    } else if (weekNumber == 5) {
                        Week5 = Week5 + 1
                    }
                });

                //Monthly
                function isJan(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 0;
                    }

                }

                function isFeb(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 1;
                    }
                }

                function isMar(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 2;
                    }
                }

                function isApr(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 3;
                    }
                }

                function isMay(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 4;
                    }
                }

                function isJune(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 5;
                    }
                }

                function isJuly(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 6;
                    }
                }

                function isAug(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 7;
                    }
                }

                function isSep(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 8;
                    }
                }

                function isOct(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 9;
                    }
                }

                function isNov(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 10;
                    }
                }

                function isDec(dateString) {
                    var date = new Date(dateString);
                    if (date.getFullYear() == new Date().getFullYear()) {
                        return date.getMonth() === 11;
                    }
                }

                // Filter the datePartArray
                var janDate = datePart.filter(isJan);
                var febDate = datePart.filter(isFeb);
                var marDate = datePart.filter(isMar);
                var aprDate = datePart.filter(isApr);
                var mayDate = datePart.filter(isMar);
                var juneDate = datePart.filter(isJune);
                var julyDate = datePart.filter(isJuly);
                var augDate = datePart.filter(isAug);
                var sepDate = datePart.filter(isSep);
                var octDate = datePart.filter(isOct);
                var novDate = datePart.filter(isNov);
                var decDate = datePart.filter(isDec);

                // Count the number
                var janCount = janDate.length;
                var febCount = febDate.length
                var marCount = marDate.length
                var aprCount = aprDate.length
                var mayCount = mayDate.length
                var juneCount = juneDate.length
                var julyCount = julyDate.length;
                var augCount = augDate.length
                var sepCount = sepDate.length
                var octCount = octDate.length
                var novCount = novDate.length
                var decCount = decDate.length

                <?php
                $labels1 = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                $labels2 = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'];
                $labels3 = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];
                ?>

                //Get all data
                $data1 = [mondayCount, tuesdayCount, wedsCount, thursCount, friCount, satCount];
                $data2 = [Week1, Week2, Week3, Week4, Week5];
                $data3 = [janCount, febCount, marCount, aprCount, mayCount, juneCount, julyCount, augCount, sepCount, octCount, novCount, decCount];

                // JavaScript for rendering the first graph
                var ctx1 = document.getElementById('myChart1').getContext('2d');
                var myChart1 = new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labels1); ?>,
                        datasets: [{
                            label: 'Daily Attendance',
                            data: $data1,
                            backgroundColor: 'rgba(15, 249, 91, 0.8)',
                            borderColor: 'white',
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white',
                                },
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white',
                                },
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white',
                                },
                            },
                        },
                    },
                });

                // JavaScript for rendering the second graph
                var ctx2 = document.getElementById('myChart2').getContext('2d');
                var myChart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labels2); ?>,
                        datasets: [{
                            label: 'Weekly Attendance',
                            data: $data2,
                            backgroundColor: 'rgba(15, 249, 91, 0.8)', // Background color for bars in the first graph
                            borderColor: 'white', // Border color of bars
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white', // Change the color of the dataset label text
                                },
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white', // Change the X-axis label color 
                                },
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white', // Change the Y-axis label color 
                                },
                            },
                        }
                    }
                });

                // JavaScript for rendering the third graph
                var ctx2 = document.getElementById('myChart3').getContext('2d');
                var myChart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labels3); ?>,
                        datasets: [{
                            label: 'Monthly Attendance',
                            data: $data3,
                            backgroundColor: 'rgba(15, 249, 91, 0.8)', // Background color for bars in the first graph
                            borderColor: 'white', // Border color of bars
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white', // Change the color of the dataset label text
                                },
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white', // Change the X-axis label color 
                                },
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white', // Change the Y-axis label color 
                                },
                            },
                        }
                    }
                });
            </script>


            <script>
                // Function to format a date as Y-m-d
                function formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }

                //Filter Data to be exported by timeframe
                function filterDataByTimeframe(data, timeframe) {
                    const currentDate = new Date();

                    const previousSunday = new Date(currentDate);
                    // Calculate the date for the previous Sunday
                    previousSunday.setDate(currentDate.getDate() - (currentDate.getDay() + 7) % 7);

                    // Format the previous Sunday date as Y-m-d
                    const previousSundayFormatted = formatDate(previousSunday);

                    var filteredData = [];

                    if (timeframe == '1_week') {
                        // Calculate the date for the Sunday one week ago
                        const oneWeekAgoSunday = new Date(previousSunday);
                        oneWeekAgoSunday.setDate(previousSunday.getDate() - 7);

                        // Format the one week ago Sunday date as Y-m-d
                        const oneWeekAgoSundayFormatted = formatDate(oneWeekAgoSunday);

                        filteredData = data.filter(date => {
                            return date >= oneWeekAgoSundayFormatted && date <= previousSundayFormatted;
                        });
                    } else if (timeframe == '2_weeks') {
                        // Calculate the date for the Sunday two weeks ago
                        const twoWeeksAgoSunday = new Date(previousSunday);
                        twoWeeksAgoSunday.setDate(previousSunday.getDate() - 14); // 7 days * 2 weeks

                        // Format the two weeks ago Sunday date as Y-m-d
                        const twoWeeksAgoSundayFormatted = formatDate(twoWeeksAgoSunday);

                        // Filter dates that fall within the week of the previous Sunday
                        filteredData = data.filter(date => {
                            return date >= twoWeeksAgoSundayFormatted && date <= previousSundayFormatted;
                        });
                    } else if (timeframe == '1_month') {
                        // Calculate the date for the first day of this month
                        const firstDayOfThisMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

                        // Format the first day of this month as Y-m-d
                        const firstDayOfThisMonthFormatted = formatDate(firstDayOfThisMonth);

                        // Filter dates that fall within this month
                        filteredData = data.filter(date => {
                            return date >= firstDayOfThisMonthFormatted && date <= previousSundayFormatted;
                        });
                    } else if (timeframe == 'this_week') {
                        // Calculate the date for the first day of this week (Sunday)
                        const firstDayOfThisWeek = new Date(currentDate);
                        firstDayOfThisWeek.setDate(currentDate.getDate() - currentDate.getDay());

                        // Calculate the date for the last day of this week (Saturday)
                        const lastDayOfThisWeek = new Date(currentDate);
                        lastDayOfThisWeek.setDate(currentDate.getDate() + (6 - currentDate.getDay()));

                        // Format the first day of this week (Sunday) as Y-m-d
                        const firstDayOfThisWeekFormatted = formatDate(firstDayOfThisWeek);

                        // Format the last day of this week (Saturday) as Y-m-d
                        const lastDayOfThisWeekFormatted = formatDate(lastDayOfThisWeek);
                        filteredData = data.filter(date => {
                            return date >= firstDayOfThisWeekFormatted && date <= lastDayOfThisWeekFormatted;
                        });
                    } else if (timeframe == 'All_Time') {
                        data.forEach(function(row) {
                            filteredData.push(row);
                        });
                    }

                    return filteredData;
                }
            </script>


            <!-- Include AJAX to fetch data -->
            <script>
                $(document).ready(function() {
                    // Function to update chart data
                    function updateChartData(chart, labels, data) {
                        chart.data.labels = labels;
                        chart.data.datasets[0].data = data;
                        chart.update();
                    }

                    $('#timeframe').on('change', function() {
                        let timeframe = $(this).val();
                        $.ajax({
                            url: 'fetch_data.php',
                            type: 'GET',
                            data: {
                                timeframe: timeframe
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (timeframe == 'daily') {
                                    updateChartData(myChart1, data.labels, data.data);
                                } else if (timeframe == 'weekly') {
                                    updateChartData(myChart2, data.labels, data.data);
                                } else if (timeframe == 'monthly') {
                                    updateChartData(myChart3, data.labels, data.data);
                                }
                            }
                        });
                    });
                });
                document.getElementById('exportButton').addEventListener('click', function() {
                    const selectedTimeframe = document.getElementById('exportTimeframe').value;
                    var filteredData = []
                    if (selectedTimeframe != "All_Time") {
                        // Assuming filterDataByTimeframe returns a valid array
                        var datesArray = filterDataByTimeframe(datePart, selectedTimeframe);

                        // Convert the JavaScript array to a JSON string
                        var jsonData = JSON.stringify(datesArray);

                        // Make an AJAX POST request to send the data to PHP
                        $.ajax({
                            type: "POST",
                            url: "process_data.php", // Replace with your PHP script's URL
                            data: {
                                datesData: jsonData
                            },
                            success: function(response) {
                                console.log("Response from PHP:", response);
                                excelPrint(JSON.parse(response))
                            }
                        });
                    } else {
                        filteredData = filterDataByTimeframe(allResult, selectedTimeframe);
                        excelPrint(filteredData)
                    }
                });

                function excelPrint(data) {
                    const wb = XLSX.utils.book_new();
                    const headers = ["ID", "Student Number", "Student Name", "Student College", "Student Program", "Time In"];
                    // Create a worksheet
                    const ws = XLSX.utils.aoa_to_sheet([headers].concat(data)); // Prepend headers as the first row
                    var colWidths
                    // Set column widths (auto-size)
                    if (data.length > 0) {
                        colWidths = data[0].map(() => ({
                            width: 15
                        }));
                        // Rest of your code here

                        // Calculate column widths based on content
                        data.forEach(row => {
                            row.forEach((cell, colIndex) => {
                                const cellValue = cell.toString();
                                if (!colWidths[colIndex] || cellValue.length > colWidths[colIndex].width) {
                                    colWidths[colIndex] = {
                                        width: cellValue.length + 2
                                    }; // Adjust for padding
                                }
                            });
                        });

                        ws['!cols'] = colWidths;

                        // Add the worksheet to the workbook
                        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                        // Generate the current date as a string (e.g., "2023-09-25")
                        const currentDate = new Date();
                        const dateString = currentDate.toISOString().split('T')[0];

                        // Define the filename based on the current date
                        const filename = `${dateString}-attendance.xlsx`;

                        // Generate the XLSX file with the specified filename
                        XLSX.writeFile(wb, filename);
                    } else {
                        // Handle the case when filteredData is empty
                        console.log("filteredData is empty");
                    }
                }
            </script>


            <?php
            include 'inc/footer.php';