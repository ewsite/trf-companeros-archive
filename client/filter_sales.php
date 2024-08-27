<?php
include('connection.php');
// echo 'HELLO'; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $startDate = $_POST['start_date'];
    // $endDate = $_POST['end_date'];
    // // $total = $_POST['total'];

    // // Prepare the database query with the date range filter
    // $query = "SELECT * FROM sales WHERE date_created BETWEEN '$startDate' AND '$endDate'";

    // $result = mysqli_query($con, $query);

    // // Check if the query was successful
    // if ($result) {
    //     // Calculate the total based on a specific column
    //     $total = 0;
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $total += $row['fullpayment'];

    //         // Display the row data as needed    
    //         echo $row['fullpayment'];
    //     }

    //     // Display the total
    //     echo "Total: " . $total;
    // } else {
    //     echo "Query failed: " . mysqli_error($con);
    // }

    // // Close the database connection
    // mysqli_close($con);

    // Retrieve the form inputs
    $startDateInput = $_POST['startDateInput'];
    $endDateInput = $_POST['endDateInput'];

    // Prepare the database query with the date range filter
    $query = "SELECT * FROM sales WHERE date_created BETWEEN '$startDateInput' AND '$endDateInput'";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        // Calculate the total based on a specific column
        $total = 0;

        // Start the HTML table
        // echo "<table>";
        // echo "<tr><th>Column 1</th><th>Column 2</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['fullpayment'];
            // $sum = 
        ?>
            <!-- Display the row data in the table -->
            <tr>
            <!-- <td><?php echo $row['fullpayment'] ?></td> -->
            <!-- <td><?php echo $row['customer_transaction_no'] ?></td>
            <td><?php echo $row['customer_no'] ?></td>
            <td><?php echo $row['packages'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['inclusion'] ?></td> -->
            <!-- <td><?php echo $row['date_created'] ?></td> -->
            <!-- <td><?php echo $row['time_schedule'] ?></td>
            <td><?php echo $row['dppayment'] ?></td> -->
            <!-- <td><?php echo $row['fullpayment'] ?></td> -->
            <!-- <td><?php echo $row['total_amount_expected'] ?></td>
            <td><?php echo $row['date_done'] ?></td>
            <td><?php echo $row['status'] ?></td> -->
            </tr> 
        <?php
        }

        // Display the total
         echo $total;

        // // Close the HTML table
        // echo "</table>";
    } else {
        echo "Query failed: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}

?>
