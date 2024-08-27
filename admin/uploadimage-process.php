<?php
if (isset($_POST['imageData'])) {
    $allowedExtensions = ["png", "jpeg", "jpg"];
    $imageData = $_POST['imageData'];
    require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;

    // Define the destination folder
    $destinationFolder = $_SERVER["DOCUMENT_ROOT"]."/admin/ref/";

    // Create the destination folder if it doesn't exist    
    if (!is_dir($destinationFolder)) {
        mkdir($destinationFolder, 0755, true);
    }

    // Extract the original name and extension from the base64 string
    list($type, $imageData) = explode(';', $imageData);
    list(, $imageData) = explode(',', $imageData);
    $extension = getExtensionFromBase64($type);

    // Check if the file extension is allowed
    if (!in_array($extension, $allowedExtensions)) {
        echo "Invalid file format. Only PNG, JPEG, and JPG files are allowed.";
        exit;
    }

    $filename = uniqid() . '.' . $extension;

    // Decode the base64-encoded image data
    $decodedImage = base64_decode($imageData);

    // Save the image to the destination folder
    file_put_contents($destinationFolder. $filename, $decodedImage);

    // Prepare the SQL statement to insert the image filename into the database
    $sql = "INSERT INTO gallery_image (gallery_image) VALUES ('$filename')";
    
    // Execute the SQL statement
    $result = mysqli_query($con, $sql);

    // Check if the SQL statement was executed successfully
    if ($result) {
        echo "Image inserted successfully.";
    } else {
        echo "Error inserting image: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "No image data received.";
}

function getExtensionFromBase64($type) {
    $extension = explode('/', $type)[1];
    return $extension;
}
?>
