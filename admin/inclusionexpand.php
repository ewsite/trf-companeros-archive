<?php 
    if (isset($_POST['expand'])) {
        $message = $_POST['expand'];
        if ($message=='') {
            echo "No Inclusion";
        }else{
        ?>
            <h4><?php echo $message;?></h4>
        <?php
        } 
    }else{
        echo "Missing Variable  ";
    }
?>