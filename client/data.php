<?php
include("connection.php");

// Retrieve the start date and end date from the query parameters
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// Establish your database connection
// $con = mysqli_connect('localhost', 'username', 'password', 'database_name');

// Prepare the SQL query to retrieve the filtered data
$query = "SELECT date_created, full_payment FROM sales WHERE date_created BETWEEN '$startDate' AND '$endDate'";

// Execute the query
$result = mysqli_query($con, $query);

// Fetch the data into an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Close the database connection
mysqli_close($con);

// Generate JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
