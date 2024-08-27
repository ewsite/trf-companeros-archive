<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST['deleteimg'])) {
    $deleteimg = $_POST['deleteimg'];
    $sql = "SELECT gallery_image FROM gallery_image WHERE id = $deleteimg";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filename = $row['gallery_image'];
        $imagePath = "images/" . $filename;

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        $deleteSql = "DELETE FROM gallery_image WHERE id = $deleteimg";
        if ($con->query($deleteSql) === true) {
            echo "Image and record deleted successfully.";
        } else {
            echo "Error deleting image record: " . $con->error;
        }
    } else {
        echo "Image not found.";
    }
}
        
?>