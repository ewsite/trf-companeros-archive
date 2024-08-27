<?php
if (isset($_POST['imageData']) && isset($_POST['customer_id']) && isset($_POST['main_id'])) {
    $imageData = $_POST['imageData'];
    $customer_id = $_POST['customer_id'];
    $main_id = $_POST['main_id'];

    // Remove the data:image/png;base64 part from the base64 data
    $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);

    // Decode the base64 data
    $imageData = base64_decode($imageData);

    // Create a unique filename for the image
    $filename = $customer_id . '_' . uniqid();
    $extension = 'jpg'; // Default extension

    // Determine the image extension based on MIME type
    $finfo = finfo_open();
    $mimeType = finfo_buffer($finfo, $imageData, FILEINFO_MIME_TYPE);

    if ($mimeType === 'image/png') {
        $extension = 'png';
    } elseif ($mimeType === 'image/jpeg' || $mimeType === 'image/jpg') {
        $extension = 'jpg';
    }

    // Append the file extension to the filename
    $filename .= '.' . $extension;

    // Specify the directory to store the image
    // Specify the directory to store the image
    $directory = $_SERVER["DOCUMENT_ROOT"]."/admin/ref/";
    $image_url = "/admin/ref/$filename";
    // Add a trailing slash to the directory path if it's missing
    if (substr($directory, -1) !== '/') {
        $directory .= '/';
    }

    // Save the image file in the specified directory
    $filepath = $directory . $filename;
    file_put_contents($filepath, $imageData);
    // Create the directory if it doesn't exist
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    // Save the image file in the specified directory
    // Insert the image filepath into the database or perform other operations
    include('connection.php');
    $sql = "UPDATE main_table SET payment_one_img = '$image_url' WHERE customer_id = '$customer_id' AND main_id = '$main_id'";

    if (mysqli_query($con, $sql)) {
        echo 'Success';
    } else {
        echo 'ERROR: ' . mysqli_error($con);
    }
} else {
    echo "Missing Variable!";
}
